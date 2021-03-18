<?php

session_start();

require '../../assets/includes/auth_functions.php';
require '../../assets/includes/datacheck.php';
require '../../assets/includes/security_functions.php';

check_logged_out();

if (!isset($_POST['loginsubmit'])){

    header("Location: ../");
    exit();
}else {

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }



    if (!verify_csrf_token()){

        $_SESSION['STATUS']['loginstatus'] = 'Request could not be validated';
        header("Location: ../");
        exit();
    }

    
    require '../../assets/setup/db.inc.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {

        $_SESSION['STATUS']['loginstatus'] = 'fields cannot be empty';
        header("Location: ../");
        exit();
    }
    else {

        $sql = "UPDATE users SET last_login=NOW() WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
            header("Location: ../");
            exit();
        }else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
        }

        $sql = "SELECT * FROM users WHERE uniid=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
            header("Location: ../");
            exit();
        }else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                $pwdCheck = password_verify($password, $row['password']);

                if ($pwdCheck == false) {

                    $_SESSION['ERRORS']['wrongpassword'] = 'wrong password';
                    header("Location: ../");
                    exit();
                }else if ($pwdCheck == true) {

                    session_start();

                    
                    if($row['verified_at'] != NULL){

                        $_SESSION['auth'] = 'verified';
                    }else{

                        $_SESSION['auth'] = 'loggedin';
                    }

                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['first_name'] = $row['first_name'];
                        $_SESSION['last_name'] = $row['last_name'];
                        $_SESSION['gender'] = $row['gender'];
                        $_SESSION['phone'] = $row['phone'];
                        $_SESSION['profile_image'] = $row['profile_image'];
                        $_SESSION['last_login'] = $row['last_login'];
                        $_SESSION['college'] = $row['college'];
                        $_SESSION['uniid'] = $row['uniid'];  
                        $_SESSION['maijor'] = $row['maijor']; 
                        $_SESSION['account'] = $row['account_type']; 
        
        
        if (isset($_POST['rememberme'])){

            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            $sql = "DELETE FROM auth_tokens WHERE user_email=? AND auth_type='remember_me';";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {

                $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                header("Location: ../");
                exit();
            }else{

                mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                mysqli_stmt_execute($stmt);
            }

            setcookie(
                'rememberme',
                $selector.':'.bin2hex($token),
                time() + 864000,
                '/',
                NULL,
                false, 
                true 
            );

            $sql = "INSERT INTO auth_tokens (user_email, auth_type, selector, token, expires_at) 
                    VALUES (?, 'remember_me', ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {

                $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                header("Location: ../");
                exit();
            }else{
                
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['email'], $selector, $hashedToken, date('Y-m-d\TH:i:s', time() + 864000));
                mysqli_stmt_execute($stmt);
            }
        }

        header("Location: ../../home/");
        exit();
    } 
}else{

    $_SESSION['ERRORS']['nouser'] = 'username does not exist';
    header("Location: ../");
    exit();
}
}
}
}
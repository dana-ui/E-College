<?php
session_start();
require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_verified();

require '../../assets/vendor/PHPMailer/src/Exception.php';
require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../../assets/vendor/PHPMailer/src/SMTP.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

if (isset($_POST['update-profile'])){

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }

    if (!verify_csrf_token()){

        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../");
        exit();
    }

    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';

    $phone = $_POST['phone'];
    $oldPassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $passwordrepeat  = $_POST['confirmpassword'];

    //img upload
    $FileNameNew = $_SESSION['profile_image'];
        $file = $_FILES['avatar'];

        if (!empty($_FILES['avatar']['name']))
        {
            $fileName = $_FILES['avatar']['name'];
            $fileTmpName = $_FILES['avatar']['tmp_name'];
            $fileSize = $_FILES['avatar']['size'];
            $fileError = $_FILES['avatar']['error'];
            $fileType = $_FILES['avatar']['type']; 

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileActualExt, $allowed))
            {
                if ($fileError === 0)
                {
                    if ($fileSize < 10000000)
                    {
                        $FileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../../assets/uploads/users/' . $FileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        /*
                        * -------------------------------------------------------------------------------
                        *   Deleting old profile photo
                        * -------------------------------------------------------------------------------
                        */
						if ( $_SESSION['profile_image'] != "_defaultUser.png" ) {
							if (!unlink('../../assets/uploads/users/' . $_SESSION['profile_image'])) {  

								$_SESSION['ERRORS']['imageerror'] = 'old image could not be deleted';
								header("Location: ../");
								exit();
							} 
						}
                    }
                    else
                    {
                        $_SESSION['ERRORS']['imageerror'] = 'image size should be less than 10MB';
                        header("Location: ../");
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                    header("Location: ../");
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
                header("Location: ../");
                exit();
            }
        }

    if(!empty($oldPassword) || !empty($newpassword) || !empty($passwordrepeat)){
        include 'password-edit.inc.php';
    }

    $sql = "UPDATE users SET phone=?, profile_image=?";
    if($passwordUpdated){
        $sql .=", password=? WHERE id=?;";
    }else{
        $sql  .= " WHERE id=?;";
    }

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['ERRORS']['scripterror'] ='SQL ERROR';
        header("Location: ../");
        exit();
    }else{
        if($passwordUpdated){
            $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,"ssss", $phone, $FileNameNew, $hashedPwd, $_SESSION['id']);
        }else{
            mysqli_stmt_bind_param($stmt,"sss", $phone, $FileNameNew, $_SESSION['id']);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $_SESSION['phone'] = $phone;
        $_SESSION['profile_image'] = $FileNameNew;
        $_SESSION['STATUS']['editstatus'] = 'Profile Updated successfully';
        header("Location: ../");
        exit();
    }

mysqli_stmt_close($stmt);
mysqli_close($conn);
}else{
    header("Location: ../");
    exit();
}
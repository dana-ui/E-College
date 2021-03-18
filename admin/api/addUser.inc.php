<?php 
if (isset($_POST['addUser'])){
require '../../assets/setup/db.inc.php';
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$uniid = $_POST['uniid'];
$phone = $_POST['phone'];
$college = $_POST['college'];
$maijor = $_POST['maijor'];
$type = $_POST['user_type'];
$userName = $uniid;
$password = password_hash($uniid, PASSWORD_DEFAULT);
$gender = $_POST['gender'];

$qurey = "INSERT INTO users (username, password, email, first_name, last_name, gender, phone, verified_at, college, uniid, maijor, account_type)
VALUES ('$userName', '$password', '$email', '$firstName', '$lastName', '$gender', '$phone', NOW(), '$college', '$uniid', '$maijor', '$type')";
$addUser = mysqli_query($conn, $qurey);
    if($addUser){
        header("Location: ../users.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../users.php");
}
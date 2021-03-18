<?php 
if (isset($_POST['updateUserProfile'])){
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
$gender = $_POST['gender'];
$target = $_POST['id'];
$query = "UPDATE users SET username = '$userName', email = '$email', first_name = '$firstName', last_name = '$lastName',
gender = '$gender', phone = '$phone', college = '$college', uniid = '$uniid', maijor = '$maijor', account_type = '$type' WHERE id = '$target'";
$edit = mysqli_query($conn, $query);
if($edit){
    header("Location: ../editUserProfile.php");
}else{
    echo"ERROR";
}

}else{
    header("Location: ../editUserProfile.php");
}
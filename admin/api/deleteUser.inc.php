<?php 
if (isset($_POST['deleteUser'])){
require '../../assets/setup/db.inc.php';
$uniid = $_POST['useid'];
$phone = $_POST['phone'];


$qurey = "DELETE FROM users WHERE uniid = '$uniid' AND phone = '$phone'";
$deleteUser = mysqli_query($conn, $qurey);
    if($deleteUser){
        header("Location: ../users.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../users.php");
}
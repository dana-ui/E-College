<?php 
if (isset($_POST['addSubject'])){
require '../../assets/setup/db.inc.php';
$subName = $_POST['subName'];
$maijor = $_POST['maijor'];
$college = $_POST['college'];
$global = $_POST['global'];

$qurey = "INSERT INTO subject (subject_name, subject_maijor, colleg_name, global)
VALUES ('$subName', '$maijor', '$college', '$global')";
$addUser = mysqli_query($conn, $qurey);
    if($addUser){
        header("Location: ../subjects.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../subjects.php");
}
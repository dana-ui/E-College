<?php 
if (isset($_POST['editClassT'])){
require '../../assets/setup/db.inc.php';
$about = $_POST['about'];
$cc = $_POST['cc'];
$cv = $_POST['cv'];
$classid = $_POST['classid'];

$query = "UPDATE classes SET aboutClass = '$about', class_code = '$cc', class_video ='$cv' WHERE class_id = '$classid'";
$edit = mysqli_query($conn, $query);
if($edit){
    header("Location: ../showClass.php?classid=$classid"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../showClass.php?classid=$classid");
}
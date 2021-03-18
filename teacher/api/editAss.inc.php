<?php 
if (isset($_POST['editAss'])){
require '../../assets/setup/db.inc.php';
$about = $_POST['about'];
$dt = $_POST['dt'];
$dd = $_POST['dd'];
$classid = $_POST['classid'];
$assid = $_POST['assid'];

$query = "UPDATE assigment SET ass_about = '$about', due_date = '$dd', due_time ='$dt' WHERE ass_id = '$assid'";
$edit = mysqli_query($conn, $query);
if($edit){
    header("Location: ../showAssigment.php?id=$assid&class=$classid"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../showAssigment.php?id=$assid&class=$classid");
}
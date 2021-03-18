<?php 
if (isset($_POST['editClass'])){
require '../../assets/setup/db.inc.php';
$cid = $_POST['cid'];
$teachere = $_POST['teachere'];
$collegee = $_POST['collegee']; 
$subjecte = $_POST['subjecte'];
$cn = $_POST['cn'];
$cStat = $_POST['cStat'];

$query = "UPDATE classes SET class_status = '$cStat', class_code = '$cn', class_college = '$collegee', class_teacher = '$teachere', class_subject = '$subjecte' WHERE class_id = '$cid'";
$edit = mysqli_query($conn, $query);
if($edit){
    header("Location: ../class.php"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../class.php");
}
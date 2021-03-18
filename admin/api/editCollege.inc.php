<?php 
if (isset($_POST['editC'])){
require '../../assets/setup/db.inc.php';
$cid = $_POST['cid'];
$cnn = $_POST['cnn'];
$query = "UPDATE college SET college_name = '$cnn' WHERE college_id = '$cid'";
$edit = mysqli_query($conn, $query);
if($edit){
    header("Location: ../manageUni.php"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../manageUni.php");
}
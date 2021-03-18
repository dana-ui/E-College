<?php 
if (isset($_POST['editM'])){
require '../../assets/setup/db.inc.php';
$mid = $_POST['mid'];
$mnn = $_POST['mnn'];
$mnc = $_POST['mnc'];

$query = "UPDATE maijor SET maijor_name = '$mnn', collegeid = '$mnc' WHERE maijor_id = '$mid'";
$edit = mysqli_query($conn, $query);
if($edit){
    header("Location: ../manageUni.php"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../manageUni.php");
}
<?php 
if (isset($_POST['addM'])){
require '../../assets/setup/db.inc.php';
$college = $_POST['collegeID'];
$mName = $_POST['maijorName'];
$sql = "INSERT INTO maijor (maijor_name, collegeid) VALUES ('$mName', '$college')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../manageUni.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../manageUni.php");
}
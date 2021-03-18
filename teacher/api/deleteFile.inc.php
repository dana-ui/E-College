<?php 
require '../../assets/setup/db.inc.php';
$mname = $_GET['mname'];
$mid = $_GET['mid'];
$classid = $_GET['classid'];
$qurey = "DELETE FROM meterials WHERE meterialid = '$mid' AND meterialName = '$mname'";
$deleteUser = mysqli_query($conn, $qurey);
    if($deleteUser){
        header("Location: ../showClass.php?classid=$classid");
    }else{
        echo"a7a";
    }
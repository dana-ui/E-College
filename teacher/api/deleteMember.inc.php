<?php 
require '../../assets/setup/db.inc.php';
$classid = $_GET['classid'];
$mid = $_GET['mid'];

$qurey = "DELETE FROM members WHERE m_user = '$mid' AND classID = '$classid'";
$deleteUser = mysqli_query($conn, $qurey);
    if($deleteUser){
        header("Location: ../showMembers.php?classid=$classid");
    }else{
        echo"a7a";
    }
<?php 
if (isset($_POST['addC'])){
require '../../assets/setup/db.inc.php';
$name = $_POST['collegeName'];
$sql = "INSERT INTO college (college_name) VALUES ('$name')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../manageUni.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../manageUni.php");
}
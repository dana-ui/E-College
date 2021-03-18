<?php 
if (isset($_POST['addClass'])){
require '../../assets/setup/db.inc.php';
$teacher = $_POST['teacher'];
$classCode = $_POST['classCode'];
$college = $_POST['college'];
$subject = $_POST['subject'];
$status = "Open";

$sql = "INSERT INTO classes (class_subject, class_teacher, class_code, class_college, status) VALUES ('$subject', '$teacher', '$classCode', '$college', '$status')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../class.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../class.php");
}
<?php 
if (isset($_POST['deleteSubject'])){
require '../../assets/setup/db.inc.php';
$sid = $_POST['sid'];
$sm = $_POST['sm'];


$qurey = "DELETE FROM subject WHERE subject_id = '$sid' AND colleg_name = '$sm'";
$deleteUser = mysqli_query($conn, $qurey);
    if($deleteUser){
        header("Location: ../subjects.php");
    }else{
        echo"a7a";
    }
}else{
    header("Location: ../subjects.php");
}
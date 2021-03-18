<?php 
if (isset($_POST['addAss'])){
require '../../assets/setup/db.inc.php';
$classid = $_POST['classid'];
$name = $_POST['assName'];
$date = date('Y-m-d');
$time = date('g:i A');
$sql = "INSERT INTO assigment (ass_name, ass_date, ass_time, class_id) VALUES ('$name', '$date', '$time', '$classid')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../showClass.php?classid=$classid"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../showClass.php?classid=$classid");
}
<?php 
if (isset($_POST['addM'])){
require '../../assets/setup/db.inc.php';
$classid = $_POST['classid'];
$mi = $_POST['mi'];
$sql = "INSERT INTO members (m_user, classID) VALUES ('$mi', '$classid')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../showClass.php?classid=$classid"); 
}else{
    echo"ERROR";
}

}else{
    header("Location: ../showClass.php?classid=$classid");
}
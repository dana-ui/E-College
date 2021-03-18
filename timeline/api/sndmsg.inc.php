<?php 
if (isset($_POST['snd'])){
require '../../assets/setup/db.inc.php';
$msgfrom = $_POST['msgfrom'];
$msgto = $_POST['msgto'];
$msg_text = $_POST['msg_text'];
$date = date('Y-m-d');
$time = date('g:i A');
$sql = "INSERT INTO messages (msg_from, msg_to, msg_date, msg_time, msg_text) VALUES ('$msgfrom', '$msgto', '$date', '$time', '$msg_text')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../index.php?userid=$msgto"); 
}else{
    echo"ERROR";
} 

}else{
    header("Location: ../index.php?userid=$msgto");
}
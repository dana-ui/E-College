<?php 
if (isset($_POST['cpost'])){
require '../../assets/setup/db.inc.php';
$postby = $_POST['postby'];
$poston = $_POST['poston'];
$postText = $_POST['postText'];
$date = date('Y-m-d');
$time = date('g:i A');
$sql = "INSERT INTO postst (post_by, post_text, post_date, post_time, post_on) VALUES ('$postby', '$postText', '$date', '$time', '$poston')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../index.php?userid=$poston"); 
}else{
    echo"ERROR";
} 

}else{
    header("Location: ../index.php?userid=$poston");
}
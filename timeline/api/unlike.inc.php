<?php 
require '../../assets/setup/db.inc.php';
$for = $_GET['for'];
$post = $_GET['post'];
$by = $_GET['by'];
$qurey = "DELETE FROM likes WHERE like_by = '$by' AND post_id = '$post'";
$deleteUser = mysqli_query($conn, $qurey);
    if($deleteUser){
        header("Location: ../index.php?userid=$for");
    }else{
        echo"a7a";
    }
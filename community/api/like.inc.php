<?php 
require '../../assets/setup/db.inc.php';
$for = $_GET['for'];
$post = $_GET['post'];
$by = $_GET['by'];
$qurey = "INSERT INTO likes (post_id, like_by) VALUES ('$post','$by')";
$deleteUser = mysqli_query($conn, $qurey);
    if($deleteUser){
        header("Location: ../");
    }else{
        echo"a7a";
    }
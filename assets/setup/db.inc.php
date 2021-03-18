<?php 
require 'env.php';
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if(!$conn){
    die("Connection failed this error happed because: ". mysqli_connect_errno());
}
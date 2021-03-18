<?php 
if (isset($_POST['addBook'])){
require '../../assets/setup/db.inc.php';

$bookName = $_POST['bookName'];
$by = $_POST['by'];
$type = $_POST['type'];
$date = date('Y-m-d');
$sql = "INSERT INTO books (book_name, book_by, addDate, book_for) VALUES ('$bookName', '$by', '$date', '$type')";
$addC = mysqli_query($conn, $sql);
    if($addC){
        header("Location: ../"); 
}else{
    echo"ERROR";
} 

}else{
    header("Location: ../");
}
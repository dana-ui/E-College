<?php 
if (isset($_POST['addM'])){
require '../../assets/setup/db.inc.php';
$classid = $_POST['classid'];
$assid = $_POST['asid'];
$query="SELECT m_user FROM members WHERE classID = '$classid'";
$stmt = mysqli_stmt_init($conn);    
if (!mysqli_stmt_prepare($stmt, $query))
{
    die('SQL error');
} 
else
{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result))
    { 
        $sql = "INSERT INTO assigment_members (ms_id, ass_id) VALUES ('$row[m_user]', '$assid')";
        $addC = mysqli_query($conn, $sql);
            if($addC){
                header("Location:  ../showAssigment.php?id=$assid&class=$classid"); 
        }else{
            echo"ERROR";
        }
            }
        }



}else{
    header("Location: ../showAssigment.php?id=$assid&class=$classid");
}
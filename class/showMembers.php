<?php
define('TITLE', 'Show Members');
include '../assets/layouts/header.php';
check_verified();
if(isset($_GET['classid'])){
    $classid = $_GET['classid'];
}else{
    header("Location: classes.php");
}
$sql = "SELECT * FROM classes WHERE class_id ='$classid'";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    die('SQL ERROR');
}else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $class = mysqli_fetch_assoc($result);
}

?>

<div class="col-xl-12">
    <div class="card">
        <div class="card-header pb-0">
            <div class="card-actions float-right">
                <div class="dropdown show">
                    <a href="#" data-toggle="dropdown" data-display="static">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-more-horizontal align-middle">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-toggle="modal" data-target="#ec">Edit Class</a>

                    </div>
                </div>
            </div>
            <h5 class="card-title mb-0"><?php echo $class['class_subject']; ?> Class <?php echo $class['class_id']; ?>
                members</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Maijor</th>
                        <th>Last Login</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $classN = $class['class_id'];
                    $query = "SELECT users.id AS 'id', users.college AS 'college', users.email AS 'email', users.maijor AS 'maijor', users.first_name AS 'first_name', users.last_login AS 'last_login', users.phone AS 'phone', users.last_name AS 'last_name', users.uniid AS 'uniid' FROM users INNER JOIN members ON members.m_user = users.uniid AND members.classID ='$classN'";
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
                            echo'
                        <tr>
                            <td>'.$row['first_name'].' '.$row['last_name'].'</td> 
                            <td>'.$row['maijor'].'</td>
                            <td>'.$row['last_login'].'</td>
                            <td>'.$row['email'].'</td>
                            <td><a href="../timeline/index.php?userid='.$row['id'].'" type="button" class="btn btn-sm btn-outline-success badge">Show Profile</a></td>
                        </tr>';
                        }
                       
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="display: none;">
    <?php include '../assets/layouts/footer.php'; ?>
</div>
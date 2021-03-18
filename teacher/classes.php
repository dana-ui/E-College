<?php
 define('TITLE', "Classes");
 include '../assets/layouts/header.php';
 if(! isset($_SESSION['auth'])){
    header("Location: ../login");
    exit();
}
 check_verified();
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
            <h5 class="card-title mb-0">Classes</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Class Number</th>
                        <th>Subject</th>
                        <th>College</th>
                        <th>Students</th>
                        <th>Join Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $teacherId = $_SESSION['id'];
                    $sql = "SELECT * FROM classes WHERE class_teacher = '$teacherId'";
                    $stmt =mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        die('ERROR IN DATABASE');
                    }else{ 
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row = mysqli_fetch_assoc($result)){
                            echo'
                        <tr>
                            <td>'.$row['class_id'].'</td>
                            <td>'.$row['class_subject'].'</td> 
                            <td>'.$row['class_college'].'</td>
                            <td>5</td>
                            <td>'.$row['class_code'].'</td>
                            <td>'.$row['class_status'].'</td>
                            <td><a href="showClass.php?classid='.$row['class_id'].'" type="button" class="btn btn-sm btn-outline-success badge">Show</a></td>
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
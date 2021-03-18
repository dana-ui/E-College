<?php
 define('TITLE', "Manage University");
 include '../assets/layouts/header.php';
 if(! isset($_SESSION['auth'])){
    header("Location: ../login");
    exit();
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3> Counter </h3>
                    <p>Colleges </p>
                </div>
                <div class="icon">
                    <i class="fa fa-university" aria-hidden="true"></i>
                </div>
                <a data-toggle="modal" data-target="#addcolege" class="card-box-footer"> Manage <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3> counter </h3>
                    <p> Maijors </p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                </div>
                <a data-toggle="modal" data-target="#addmaijor" class="card-box-footer"> Manage <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> 5464 </h3>
                    <p> Subjects </p>
                </div>
                <div class="icon">
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <a href="subjects.php" class="card-box-footer">Manage <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-red">
                <div class="inner">
                    <h3> 723 </h3>
                    <p> Classes </p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="class.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</div>

<!-- manage colleges -->
<div class="modal fade" id="addcolege" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Colleges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/manageCollege.inc.php" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">add College:</label>
                        <input type="text" name="collegeName" class="form-control" id="recipient-name"
                            placeholder="Enter College Name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addC" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>

            <br>



            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Added Colleges</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $sql = "SELECT * FROM college";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql))
                            {
                                die('SQL ERROR');
                            }else{
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo'
                                    <tr class="active">
                                    <th scope="row">'.$row['college_id'].'</th>
                                    <td>'.$row['college_name'].'</td>
                                    <td><a data-toggle="modal" data-target="#editC" type="button" class="btn btn-sm btn-outline-warning badge">Edit</a></td>
                                </tr>
                                    ';
                                }
                            }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="editC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit College</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/editCollege.inc.php" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Collge ID:</label>
                        <input type="text" class="form-control" name="cid" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient" class="col-form-label">New Name:</label>
                        <input type="text" class="form-control" name="cnn" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="editC" type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- *///// MAIJOR MANAGE*/////// -->
<div class="modal fade" id="addmaijor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Maijors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/addMaijor.inc.php" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Maijor Name:</label>
                        <input type="text" name="maijorName" class="form-control" id="recipient-name"
                            placeholder="Enter Maijor Name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">College ID:</label>
                        <input type="text" name="collegeID" class="form-control" id="recipient-name"
                            placeholder="Enter College ID">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addM" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>

            <br>



            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Added Maijors</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>College ID</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $sql = "SELECT * FROM maijor";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql))
                            {
                                die('SQL ERROR');
                            }else{
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo'
                                    <tr class="active">
                                    <th scope="row">'.$row['maijor_id'].'</th>
                                    <td>'.$row['maijor_name'].'</td>
                                    <td>'.$row['collegeid'].'</td>
                                    <td><a data-toggle="modal" data-target="#editM" type="button" class="btn btn-sm btn-outline-warning badge">Edit</a></td>
                                </tr>
                                    ';
                                }
                            }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="editM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Maijor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/editMaijor.inc.php" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Maijor ID:</label>
                        <input type="text" class="form-control" name="mid" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient" class="col-form-label">New Name:</label>
                        <input type="text" class="form-control" name="mnn" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient" class="col-form-label">New College:</label>
                        <input type="text" class="form-control" name="mnc" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="editM" type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div style="display: none;">
    <?php include '../assets/layouts/footer.php'; ?>
</div>
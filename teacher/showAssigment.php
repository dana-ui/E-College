<?php
define('TITLE', 'Show Assigment');
include '../assets/layouts/header.php';
check_verified();
if(isset($_GET['id'])){
    $assid = $_GET['id'];
    $class = $_GET['class'];
}else{
    header("Location: classes.php");
}
$sql = "SELECT * FROM assigment WHERE ass_id ='$assid'";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    die('SQL ERROR');
}else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $ass = mysqli_fetch_assoc($result);
}
?>


<section class="container ng-scope ng-fadeInLeftShort">
    <!-- uiView:  -->
    <div class="ng-fadeInLeftShort ng-scope">
        <div class="container-overlap bg-blue-500 ng-scope">
            <div class="media m0 pv">
                <div class="media-left"><a href="#"><img src="../assets/images/book.png" alt="User"
                            class="media-object img-circle thumb64"></a></div>
                <div class="media-body media-middle">
                    <h4 class="media-heading text-white"><?php echo $ass['ass_name']; ?></h4>
                    <span class="text-white">Assigment ID: <?php echo $ass['ass_id']; ?></span>
                </div>
            </div>
        </div>
        <div class="container-fluid ng-scope">
            <div class="row">
                <!-- Left column-->
                <div class="col-md-7 col-lg-8">
                    <form class="card ng-pristine ng-valid">
                        <h5 class="card-heading pb0">
                            Assigment instructions:
                        </h5>
                        <div class="card-body">
                            <p class="ng-scope ng-binding editable"><?php echo $ass['ass_about']; ?></p>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-offset">
                            <div class="card-offset-item text-right">
                                <a data-toggle="modal" data-target="#editclass" type="button"
                                    class="btn-raised btn btn-warning btn-circle btn-lg"><em
                                        class="fa fa-edit"></em></a>
                                <a data-toggle="modal" data-target="#am" type="button"
                                    class="btn-raised btn btn-success btn-circle btn-lg ng-hide"><em
                                        class="fa fa-user-plus"></em></a>
                                <a data-toggle="modal" data-target="#up"
                                    class="btn-raised btn btn-primary btn-circle btn-lg ng-hide"><em
                                        class="fa fa-upload"></em></a>
                            </div>
                        </div>
                        <h5 class="card-heading pb0">Assigment Information</h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>Creation Date:
                                        </td>
                                        <td class="ng-binding"><?php echo $ass['ass_date']; ?> at
                                            <?php echo $ass['ass_time']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-ios-body icon-fw mr"></em>Due: </td>
                                        <td><span class="ng-scope ng-binding editable"><?php echo $ass['due_date']; ?>
                                                <?php echo $ass['due_time']; ?></span>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5 class="card-heading pb0">Assigment Files</h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Download</th>
                                        <th>Date</th>
                                        <th>Caption</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $assN = $ass['ass_id'];
                                $query = "SELECT * FROM meterials WHERE ass_id = '$assN'";
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
                                        <td><em class="ion-document-text icon-fw mr">'.$row['meterialid'].'</td> 
                                        <td class="ng-binding"><a href="uploads/files/'.$row['meterialName'].'" type="button" class="btn btn-sm btn-outline-success badge" target="_blank">Download</a></td>
                                        <td><em class="ion-document-text icon-fw mr">'.$row['upTime'].'</td>
                                        <td><em class="ion-document-text icon-fw mr">'.$row['caption'].'</td>
                                    </tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- SUBMISSIONS -->
                        <h5 class="card-heading pb0">Assigment Submissions</h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>File</th>
                                        <th>Date</th>
                                        <th>By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $assN = $ass['ass_id'];
                                $query = "SELECT  users.first_name AS 
                        'first_name', users.last_name AS 'last_name', users.id AS 'id', submission.sub_at AS 'date', submission.sub_file AS 'file' FROM users INNER JOIN 
                        submission ON submission.sub_by = users.id AND submission.as_id ='$assN'";
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
                                        
                                        <td class="ng-binding"><a href="uploads/files/'.$row['file'].'" type="button" class="btn btn-sm btn-outline-success badge" target="_blank">Open File</a></td>
                                        <td><em class="ion-document-text icon-fw mr">'.$row['date'].'</td>
                                        <td><em class="ion-document-text icon-fw mr">'.$row['first_name'].' '.$row['first_name'].'</td>
                                    </tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>


                        <!-- endFilesInfo -->
                        <div class="card-divider"></div>
                    </form>
                </div>
                <!-- Right column-->
                <div class="col-md-5 col-lg-4">
                    <div class="card">
                        <h5 class="card-heading">
                            Added Students
                        </h5>
                        <div class="mda-list">

                            <?php
                        $classN = $ass['ass_id'];
                        $query = "SELECT users.profile_image AS 'profile_image', users.first_name AS 
                        'first_name', users.last_name AS 'last_name', users.uniid AS 'uniid' FROM users INNER JOIN assigment_members ON assigment_members.ms_id = users.uniid AND assigment_members.ass_id ='$classN'";
                        
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
                            <div class="mda-list-item"><img src="../assets/uploads/users/'.$row['profile_image'].'"
                                    alt="List user" class="mda-list-item-img">
                                <div class="mda-list-item-text mda-2-line">
                                    <h3><a href="#">'.$row['first_name'].' '.$row['last_name'].'</a></h3>
                                    <div class="text-muted text-ellipsis">'.$row['uniid'].'</div>
                                </div>
                            </div>';
                                    }
                                }
                                ?>

                        </div>
                        <div class="card-divider"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ASSIGMENT DETAILS -->
<div class="modal fade" id="up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finsh Set for <?php echo $ass['ass_name']; ?>
                    assigment
                    <?php echo $ass['ass_id']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="api/addFileC.inc.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <br>
                        <div class="custom-file">
                            <input name="upFile" type="file" class="custom-file-input" id="inputGroupFile01" required>
                            <input style="display: none;" name="assId" value=" <?php echo $ass['ass_id']; ?>">
                            <input style="display: none;" name="ssId" value=" <?php echo $class; ?>">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        <br>

                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Caption</span>
                        </div>
                        <textarea name="caption" required class="form-control" aria-label="Caption"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addFile" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Edit ASSIGMENT -->
<div class="modal fade" id="editclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $ass['ass_name']; ?> Assigment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/editAss.inc.php" method="post">
                    <div class="form-group">
                        <input style="display: none;" name="assid" value=" <?php echo $ass['ass_id']; ?>">
                        <input style="display: none;" name="classid" value=" <?php echo $class; ?>">
                        <label for="recipient-name" class="col-form-label">Due date:</label>
                        <input type="date" class="form-control" name="dd">
                        <label for="recipient-name" class="col-form-label">Due time:</label>
                        <input type="time" class="form-control" name="dt">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">instructions:</label>
                        <textarea name="about" class="form-control"
                            id="message-text"><?php echo $ass['ass_about']; ?></textarea>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="editAss" type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- add Member -->
<div class="modal fade" id="am" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add all members to <?php echo $ass['ass_name']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>by clicking on add youll add all the class members to this assigment</p>
                <form action="api/openAssigment.inc.php" method="post">
                    <div class="form-group">
                        <input style="display: none;" name="classid" value=" <?php echo $class; ?>">
                        <input style="display: none;" name="asid" value=" <?php echo $ass['ass_id']; ?>">
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="addM" type="submit" class="btn btn-success">add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include '../assets/layouts/footer.php'; ?>
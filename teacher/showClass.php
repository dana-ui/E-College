<?php
define('TITLE', 'Show Class');
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

<section class="container ng-scope ng-fadeInLeftShort">
    <!-- uiView:  -->
    <div class="ng-fadeInLeftShort ng-scope">
        <div class="container-overlap bg-blue-500 ng-scope">
            <div class="media m0 pv">
                <div class="media-left"><a href="#"><img src="../assets/images/book.png" alt="User"
                            class="media-object img-circle thumb64"></a></div>
                <div class="media-body media-middle">
                    <h4 class="media-heading text-white"><?php echo $class['class_subject']; ?></h4>
                    <span class="text-white">Class Number: <?php echo $class['class_id']; ?></span>
                </div>
            </div>
        </div>
        <div class="container-fluid ng-scope">
            <div class="row">
                <!-- Left column-->
                <div class="col-md-7 col-lg-8">
                    <form class="card ng-pristine ng-valid">
                        <h5 class="card-heading pb0">
                            About Class
                        </h5>
                        <div class="card-body">
                            <p class="ng-scope ng-binding editable"><?php echo $class['aboutClass']; ?></p>
                            <iframe width="100%" height="315"
                                src="https://www.youtube.com/embed/<?php echo $class['class_video']; ?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
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
                        <h5 class="card-heading pb0">Class Information</h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><em class="ion-document-text icon-fw mr"></em>College:
                                        </td>
                                        <td class="ng-binding"><?php echo $class['class_college']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-egg icon-fw mr"></em>Class Status:</td>
                                        <td><span
                                                class="ng-scope ng-binding editable"><?php echo $class['class_status']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-ios-body icon-fw mr"></em>Join Code: </td>
                                        <td><span
                                                class="ng-scope ng-binding editable"><?php echo $class['class_code']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-man icon-fw mr"></em>Total Students: </td>
                                        <td><span class="ng-scope ng-binding editable"><?php
                                                $classz = $class['class_id'];
                                                $query1= mysqli_query($conn,"SELECT count(*) AS 'countS' FROM members
                                                WHERE classID = '$classz'");
                                                $row= mysqli_fetch_array($query1);
                                                $count_S = $row['countS'];
                                                echo $row["countS"];
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><em class="ion-android-home icon-fw mr"></em>Total Files</td>
                                        <td><span class="ng-scope ng-binding editable"><?php
                                        $class1 = $class['class_id'];
                                        $query= mysqli_query($conn,"SELECT count(*) AS 'countF' FROM meterials WHERE Classid = '$class1'");
                                        $row= mysqli_fetch_array($query);
                                        $count_F = $row['countF'];
                                        echo $row["countF"];
                                        ?></span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5 class="card-heading pb0">Class Files</h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Download</th>
                                        <th>Date</th>
                                        <th>Caption</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                        $classN = $class['class_id'];
                        $query = "SELECT * FROM meterials WHERE Classid = '$classN'";
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
                                        <td class="ng-binding"> <a href="api/deleteFile.inc.php?mname='.$row['meterialName'].'&mid='.$row['meterialid'].'&classid='.$classN.'"  type="button" class="btn btn-sm btn-outline-danger badge">Delete</a></td>

                                    </tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- endFilesInfo -->
                        <h5 class="card-heading pb0">Class Assigments</h5>
                        <div class="card-body">
                            <a style="color: #ffffff;" data-toggle="modal" data-target="#assigment" type="button"
                                class="btn btn-primary">Add
                                New Assigment</a>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Due</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $classN = $class['class_id'];
                                $query = "SELECT * FROM assigment WHERE class_id = '$classN'";
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
                                        <td><em class="ion-document-text icon-fw mr">'.$row['ass_id'].'</td>
                                        <td><em class="ion-document-text icon-fw mr">'.$row['ass_name'].'</td> 
                                        <td><em class="ion-document-text icon-fw mr">'.$row['ass_date'].'</td>
                                        <td><em class="ion-document-text icon-fw mr">'.$row['due_date'].' '.$row['due_time'].'</td>
                                        <td class="ng-binding"> <a href="showAssigment.php?id='.$row['ass_id'].'&class='.$classN.'"  type="button" class="btn btn-sm btn-outline-success badge">Open</a></td>

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
                            Last Added
                        </h5>
                        <div class="mda-list">

                            <?php
                        $classN = $class['class_id'];
                        $query = "SELECT users.profile_image AS 'profile_image', users.first_name AS 
                        'first_name', users.last_name AS 'last_name', users.uniid AS 'uniid' FROM users INNER JOIN members ON members.m_user = users.uniid AND members.classID ='$classN' LIMIT 5";
                        
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
                        <div class="card-body pv0 text-right"><a
                                href="showMembers.php?classid=<?php echo $class['class_id']; ?>"
                                class=" btn btn-flat btn-info">View all</a>
                        </div>
                        <div class="card-divider"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- edit class -->

<div class="modal fade" id="editclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $class['class_subject']; ?> Class
                    <?php echo $class['class_id']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/editClass.inc.php" method="post">
                    <div class="form-group">
                        <input style="display: none;" name="classid" value=" <?php echo $class['class_id']; ?>">
                        <label for="recipient-name" class="col-form-label">Class Join Code:</label>
                        <input type="text" class="form-control" name="cc" value=" <?php echo $class['class_code']; ?>">
                        <label for="recipient-name" class="col-form-label">Class video:</label>
                        <input type="text" class="form-control" name="cv" value=" <?php echo $class['class_video']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">About Class:</label>
                        <textarea name="about" class="form-control"
                            id="message-text"><?php echo $class['aboutClass']; ?></textarea>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="editClassT" type="submit" class="btn btn-success">Save Changes</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Add member to <?php echo $class['class_subject']; ?>
                    Class
                    <?php echo $class['class_id']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/addToClass.inc.php" method="post">
                    <div class="form-group">
                        <input style="display: none;" name="classid" value=" <?php echo $class['class_id']; ?>">
                        <input type="text" class="form-control" name="mi" placeholder="Enter Member ID">
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

<!-- upload File -->
<div class="modal fade" id="up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload file to <?php echo $class['class_subject']; ?>
                    class
                    <?php echo $class['class_id']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="api/addFile.inc.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <br>
                        <div class="custom-file">
                            <input name="upFile" type="file" class="custom-file-input" id="inputGroupFile01" required>
                            <input style="display: none;" name="classid" value=" <?php echo $class['class_id']; ?>">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        <br>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Caption</span>
                        </div>
                        <textarea name="caption" required class="form-control" aria-label="Caption"></textarea>
                    </div>

                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addFile" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Add assigment -->
<div class="modal fade" id="assigment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Assigment to
                    <?php echo $class['class_subject']; ?>
                    class
                    <?php echo $class['class_id']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="api/addAss.inc.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group mb-3">

                        <br>
                        <div class="input-group">
                            <input name="assName" type="text" class="form-control" placeholder="assigment name"
                                required>
                            <input style="display: none;" name="classid" value=" <?php echo $class['class_id']; ?>">

                        </div>
                        <br>
                    </div>

                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addAss" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php include '../assets/layouts/footer.php'; ?>
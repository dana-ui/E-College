<?php
define('TITLE', 'Community');
include '../assets/layouts/header.php';
check_verified();
?>

<div class="container padding-bottom-3x mb-2">
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(https://bootdey.com/img/Content/bg1.jpg);">
                    <div class="info-label" data-toggle="tooltip" title=""
                        data-original-title="You currently have 290 Reward Points to spend"><i
                            class="icon-medal"></i><?php echo $_SESSION['account']?></div>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="../assets/uploads/users/<?php echo $_SESSION['profile_image']?>" alt="User">
                    </div>
                    <div class="user-data">
                        <h4><?php echo $_SESSION['first_name']?> <?php echo $_SESSION['last_name']?></h4><span>ID:
                            <?php echo $_SESSION['uniid']?></span>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
                <a class="list-group-item with-badge active" data-toggle="tab" aria-expanded="true" href="#feeds"><i
                        class="fa fa-th"></i>Feeds</a>
                <a class="list-group-item" data-toggle="tab" aria-expanded="false" href="#ADV"><i
                        class="fa fa-book"></i>College Book's</a>
                <a class="list-group-item" data-toggle="tab" aria-expanded="false" href="#unibook"><i
                        class="fa fa-university"></i>University
                    Book's</a>
                <a class="list-group-item with-badge" data-toggle="tab" aria-expanded="false" href="#Ebook"><i
                        class="fa fa-at"></i>E-Books</a>
                <a class="list-group-item with-badge" href="#"><i class="fa fa-info"></i>College Announcements</a>

            </nav>
        </div>
        <div class="tab-content col-xl-8">
            <div class=" tab-pane show active" id="feeds" aria-expanded="true">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>

                <!-- POST-->
                <?php
                
            $sql ="SELECT postst.post_on AS 'on', users.id AS 'id', postst.post_id AS 'post_id', postst.post_text AS'post_text', postst.post_date AS 'post_date',
            postst.post_time AS 'post_time', users.account_type AS 'type', users.first_name AS 'first_name', users.last_name AS 'last_name',
            users.profile_image AS 'profile_image'FROM postst INNER JOIN users  ON 
             postst.post_by = users.id  ORDER BY postst.post_id DESC";
            $stmt = mysqli_stmt_init($conn);    
            if (!mysqli_stmt_prepare($stmt, $sql))
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
            <div class="comment">
                <div class="comment-author-ava">
                <img src="../assets/uploads/users/'.$row['profile_image'].'"
                        alt="Avatar"></div>
                <div class="comment-body">
                    <p class="comment-text">'.$row['post_text'].'
                    </p>
                    <div class="comment-footer"><span class="comment-meta1"><a href="../timeline/index.php?userid='.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].'</a> - '.$row['type'].'
                    at '.$row['post_date'].' '.$row['post_time'].'</span></div>
                    <hr>
                    ';
                    $owner =$row['on'];
                    $post=$row['post_id'];
                    $query= mysqli_query($conn,"SELECT count(*) AS 'countL' FROM likes WHERE post_id = '$row[post_id]'");
                    $row= mysqli_fetch_array($query);
                    $count_F = $row['countL'];
                    // liked or not
                    $sql= mysqli_query($conn,"SELECT count(*) AS 'Liked' FROM likes WHERE post_id = '$post' AND 
                    like_by = '$_SESSION[id]'");
                    $row1= mysqli_fetch_array($sql);
                    $like = $row1['Liked'];
                    if($row1['Liked'] == 0){
                        echo'
                        <a href="api/like.inc.php?by='.$_SESSION['id'].'&post='.$post.'&for='.$owner.'" type="button" class="btn btn-primary comment-meta"><i class="fa fa-thumbs-up "></i> Like</a>';
                    }else{
                        echo'<a href="api/unlike.inc.php?by='.$_SESSION['id'].'&post='.$post.'&for='.$owner.'" type="button" class="btn btn-secondary comment-meta"><i class="fa fa-thumbs-down "></i> Unlike</a>';
                    }
                        echo'
                    <div class="stats" style="float: right;">
                    <span class="fa-stack fa-fw stats-icon">
                        <i class="fa fa-thumbs-up fa-stack-1x fa-inverse" style="color:#007bff;"></i>
                    </span>
                    <span class="comment-meta1">'.$row["countL"].' like on this post </span>
                </div>
                </div>
                
            </div>';
                }
            }
            ?>

            </div>
            <!-- CBOOKS -->
            <div class="tab-pane" id="ADV">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-8 col-lg-6">
                            <!-- Section Heading-->
                            <br>
                            <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s"
                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">

                                <button data-toggle="modal" data-target="#newBook" style="color: #ffffff;" type="button"
                                    class="btn btn-success"><i class="fa fa-book"></i>
                                    Give a Book</button>
                                <br>
                                <div class="line"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">
                                        <div class="table-responsive">
                                            <table class="table user-list">
                                                <thead>
                                                    <tr>
                                                        <th><span>Book Name</span></th>
                                                        <th><span>Created at</span></th>
                                                        <th class="text-center"><span>College</span></th>
                                                        <th><span>Contact</span></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Book Advisor-->
                                                    <?php 
                        $type = $_SESSION['college'];
                        $me = $_SESSION['id'];
                        $query = "SELECT * FROM books WHERE book_for = '$type' AND book_by != '$me'";
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
                            <td>
                                
                                <h6>'.$row["book_name"].'</h6>
                                
                            </td>
                            <td>
                            '.$row["addDate"].'
                            </td>
                            <td class="text-center">
                                <span class="label label-default">'.$row["book_for"].'</span>
                            </td>
                            <td>
                                <a type="button" class="btn btn-success" href="../timeline/index.php?userid='.$row["book_by"].'">Contact With Owner</a>
                            </td>
                            
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
                </div>
            </div>


            <!-- UBOOKS -->
            <div class="tab-pane" id="unibook">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-8 col-lg-6">
                            <!-- Section Heading-->
                            <br>
                            <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s"
                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">

                                <button data-toggle="modal" data-target="#UnewBook" style="color: #ffffff;"
                                    type="button" class="btn btn-success"><i class="fa fa-book"></i>
                                    Give a Book</button>
                                <br>
                                <div class="line"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">
                                        <div class="table-responsive">
                                            <table class="table user-list">
                                                <thead>
                                                    <tr>
                                                        <th><span>Book Name</span></th>
                                                        <th><span>Created at</span></th>
                                                        <th class="text-center"><span>College</span></th>
                                                        <th><span>Contact</span></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Book Advisor-->
                                                    <?php 
                        $type = "global";
                        $me = $_SESSION['id'];
                        $query = "SELECT * FROM books WHERE book_for = '$type' AND book_by != '$me'";
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
                            <td>
                                
                                <h6>'.$row["book_name"].'</h6>
                                
                            </td>
                            <td>
                            '.$row["addDate"].'
                            </td>
                            <td class="text-center">
                                <span class="label label-default">'.$row["book_for"].'</span>
                            </td>
                            <td>
                                <a type="button" class="btn btn-success" href="../timeline/index.php?userid='.$row["book_by"].'">Contact With Owner</a>
                            </td>
                            
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
                </div>
            </div>
            <!-- EBOOKS  -->

            <div class="tab-pane" id="Ebook">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-8 col-lg-6">
                            <!-- Section Heading-->
                            <br>
                            <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s"
                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">

                                <button data-toggle="modal" data-target="#up" style="color: #ffffff;" type="button"
                                    class="btn btn-success"><i class="fa fa-book"></i>
                                    Give a Book</button>
                                <br>
                                <div class="line"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">
                                        <div class="table-responsive">
                                            <table class="table user-list">
                                                <thead>
                                                    <tr>
                                                        <th><span>Book Name</span></th>
                                                        <th><span>Created at</span></th>
                                                        <th class="text-center"><span>College</span></th>
                                                        <th><span>Contact</span></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Book Advisor-->
                                                    <?php 
                        $type = "EBOOK";
                        $query = "SELECT * FROM books WHERE book_file IS NOT NULL";
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
                            <td>
                                
                                <h6>'.$row["book_name"].'</h6>
                                
                            </td>
                            <td>
                            '.$row["addDate"].'
                            </td>
                            <td class="text-center">
                                <span class="label label-default">'.$row["book_for"].'</span>
                            </td>
                            <td>
                                <a type="button" class="btn btn-success" href="../teacher/uploads/files/'.$row['book_file'].'">Show</a>
                            </td>
                            
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
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="newBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/addCbook.inc.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="by" value="<?php echo $_SESSION['id'];?>"
                            style="display: none;">
                        <input type="text" class="form-control" name="type" value="<?php echo $_SESSION['college'];?>"
                            style="display: none;">
                        <input type="text" class="form-control" name="bookName" placeholder="Book Name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="addBook" type="submit" class="btn btn-success">Add New Book</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="UnewBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="api/addCbook.inc.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="by" value="<?php echo $_SESSION['id'];?>"
                            style="display: none;">
                        <input type="text" class="form-control" name="type" value="global" style="display: none;">
                        <input type="text" class="form-control" name="bookName" placeholder="Book Name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button name="addBook" type="submit" class="btn btn-success">Add New Book</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- EBOOK -->
<div class="modal fade" id="up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="api/addEbook.inc.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <br>
                        <div class="custom-file">
                            <input name="upFile" type="file" class="custom-file-input" id="inputGroupFile01" required>
                            <input type="text" class="form-control" name="by" value="<?php echo $_SESSION['id'];?>"
                                style="display: none;">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        <br>
                    </div>
                    <input type="text" class="form-control" name="bookName" placeholder="Book Name" required>

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
<?php include '../assets/layouts/footer.php'; ?>
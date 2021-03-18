<?php
define('TITLE', 'Edit Profile');
include '../assets/layouts/header.php';
check_verified();


function xss_filter($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form class="form-auth" action="api/profile-edit.inc.php" method="post" enctype="multipart/form-data"
                autocomplete="off">
                <?php insert_csrf_token();?>

                <div class="picCard text-center">
                    <div class="avatar-upload">
                        <div class="avatar-preview text-center">
                            <div id="imagePreview"
                                style="background-image: url( ../assets/uploads/users/<?php echo $_SESSION['profile_image'] ?> );">
                            </div>
                        </div>
                        <div class="avatar-edit">
                            <input name="avatar" id="avatar" class="fas fa-pencil" type="file" />
                            <label for="avatar"></label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['imageerror']))
                                echo $_SESSION['ERRORS']['imageerror'];

                        ?>
                    </sub>
                </div>
                <div class="text-center">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['editstatus']))
                                echo $_SESSION['STATUS']['editstatus'];

                        ?>
                    </small>
                </div>

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Edit Your Profile</h6>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Your Phone Number"
                        value="<?php echo xss_filter($_SESSION['phone']);?>" autocomplete="off">
                </div>
                <hr>
                <span class="h5 font-weight-normal text-muted mb-4">Password Edit</span>
                <br>
                <sub class="text-danger mb-4">
                    <?php
                            if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS']['passworderror'];

                        ?>
                </sub>
                <br>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Current Password" autocomplete="New Password">
                </div>
                <div class="form-group">
                    <input type="password" id="newpassword" name="newpassword" class="form-control"
                        placeholder="New Password" autocomplete="New Password">
                </div>
                <div class="form-group">
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control"
                        placeholder="Confirm Password" autocomplete="New Password">
                </div>
                <button class="btn btn-lg btn-primary btn-block mb-5" type="submit" name="update-profile">Confirm
                    Changes</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php include '../assets/layouts/footer.php';?>
<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);

        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#avatar").change(function() {
    console.log("here");
    readURL(this);
});
</script>
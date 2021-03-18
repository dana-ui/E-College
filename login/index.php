<?php
define('TITLE', 'Login');
include '../assets/layouts/header.php';
check_logged_out();
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form class="form-auth" action="api/login.inc.php" method="post">
                <?php insert_csrf_token();?>
                <div class="text-center">
                    <img class="mb-1" src="../assets/images/logo.png" alt="E-College" width="130" height="130">
                </div>
                <h6 class="h3 mb-3 font-weight-normal text-muted text-center">
                    Login!
                </h6>
                <div class="mb-3 text-center">
                    <small class="text-danger font-weight-bold">
                        <?php 
                            if(isset($_SESSION['STATUS']['loginstatus']))
                            echo $_SESSION['STATUS']['loginstatus'];                
                        ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="username" class="sr-only">ID</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Your ID:"
                        required autofocus>
                    <sub class="text-danger">
                        <?php 
                            if(isset($_SESSION['ERRORS']['nouser']))
                            echo $_SESSION['ERRORS']['nouser'];                
                        ?>
                    </sub>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password:"
                        required autofocus>
                    <sub class="text-danger">
                        <?php 
                            if(isset($_SESSION['ERRORS']['wrongpassword']))
                            echo $_SESSION['ERRORS']['wrongpassword'];                
                        ?>
                    </sub>
                </div>
                <div class="col-auto my-1 mb-4">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
                        <label class="custom-control-label" for="rememberme">Remember me</label>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" value="loginsubmit"
                    name="loginsubmit">Login</button>

                <p class="mt-3 text-muted text-center">
                    <a href="#">Forgot Password?</a>
                </p>

            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>





<?php include '../assets/layouts/footer.php'; ?>
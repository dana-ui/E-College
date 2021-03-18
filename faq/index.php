<?php
 define('TITLE', "FAQ");
 include '../assets/layouts/header.php';
 if(! isset($_SESSION['auth'])){
    header("Location: ../login");
    exit();
}
 check_verified();
?>


<?php include '../assets/layouts/footer.php'; ?>
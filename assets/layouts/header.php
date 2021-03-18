<?php
    session_start();
    require '../assets/setup/env.php';
    require '../assets/setup/db.inc.php';
    require '../assets/includes/auth_functions.php';
    require '../assets/includes/security_functions.php';
    if (isset($_SESSION['auth']))
    if (isset($_SESSION['auth']))
    $_SESSION['expire'] = ALLOWED_INACTIVITY_TIME;

    generate_csrf_token();
    check_remember_me();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="<?php echo APP_DESCRIPTION;  ?>">
    <meta name="author" content="<?php echo APP_OWNER;  ?>">
    <title><?php echo TITLE . ' | ' . APP_NAME; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/vendor/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome-5.12.0/css/all.css" rel="stylesheet">
    <!-- Custom Style For E-College -->
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="extra.css" rel="stylesheet">

</head>

<body>
    <?php require 'navbar.php'; ?>
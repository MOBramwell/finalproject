<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

switch ($action) {
    case 'updatecomplaint':
        $_GET['cid'] = $id;
        include('updatecomplaint.php');
        break;
    case 'userprofile':
        $_GET['uid'] = $id;
        include('userprofile.php');
        break;
    default:
        die('Invalid action');
}

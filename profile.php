<?php
    session_start();
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('index', ["error" => "You need to be logged in to view this page"]);
    }

    $title = 'Profile Page';
    require  __DIR__ . "/inc/header.php"; 
?>   

<h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>

<?php require __DIR__ . "/inc/footer.php"; ?>
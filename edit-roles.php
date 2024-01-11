<?php
    session_start();
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('index', ["error" => "You need to be logged in to view this page"]);
    }
?>

<?php $title = 'Edit Roles Page'; require __DIR__ . "/inc/header.php"; ?>
     
<?php require __DIR__ . "/components/roles/edit-roles.php"; ?>

<?php require __DIR__ . "/inc/footer.php"; ?>
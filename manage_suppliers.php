<?php
    session_start();
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('index', ["error" => "You need to be logged in to view this page"]);
    }
?>

<?php $title = 'Suppliers Management Page'; require __DIR__ . "/inc/header.php"; ?>
     
<?php require __DIR__ . "/components/suppliers-components/manage-suppliers-component.php"; ?>

<?php require __DIR__ . "/inc/footer.php"; ?>
<?php
    session_start();
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('index', ["error" => "You need to be logged in to view this page"]);
    }
?>

<?php $title = 'Menu'; require __DIR__ . "/inc/header.php";?>

<a class="btn btn-danger btn-sm mt-2" type="submit" href="./inventory.php" >Logout</a>
<a class="btn btn-danger btn-sm mt-2" type="submit" href="./suppliers.php" >Logout</a>
<a class="btn btn-danger btn-sm mt-2" type="submit" href="./users.php" >Logout</a>
<a class="btn btn-danger btn-sm mt-2" type="submit" href="./categories.php" >Logout</a>

<?php require __DIR__ . "/inc/footer.php"; ?>
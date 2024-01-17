<?php
    session_start();
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('index', ["error" => "You need to be logged in to view this page"]);
    }
?>

<?php $title = 'Profile Page'; require __DIR__ . "/inc/header.php"; ?>

<section class="vh-750 mt-5">
    <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center w-100 h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong my-5" style="border-radius: 1rem;">
                    <div class="card-body px-5 py-3 text-center">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="Profile Picture" 
                            style="width: 100px; height: auto;">
                        <h3 class="my-2">Name:</h3>
                        <h3 class="my-2"><?php echo ($_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'])?></h3>
                        <h3 class="my-2">Email:</h3>
                        <h3 class="mt-2 mb-4"><?php echo $_SESSION['user']['email']?></h3>
                        <?php echo "<a href='edit_users.php?id=" . $_SESSION['user']["ID"] . "'class='btn btn-warning btn-lg w-100'>Edit Details</a>";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
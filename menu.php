<?php
    session_start();
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('index', ["error" => "You need to be logged in to view this page"]);
    }
?>

<?php $title = 'Menu'; require __DIR__ . "/inc/header.php";?>

<section>
    <div class="text-center">
        <h1 class="display-4">Welcome to Admin Home</h1>
        <div class="justify-content-center align-items-center mx-5 mt-5" style="height: 100vh;">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="manage_roles.php" class="card text-decoration-none text-center">
                        <div class="card-body bg-primary" style="height: 200px;">
                            <h5 class="card-title text-dark" style="font-size: 24px; line-height: 150px;">Manage Roles</h5>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="manage_users.php" class="card text-decoration-none text-center">
                        <div class="card-body bg-secondary" style="height: 200px;">
                            <h5 class="card-title text-dark" style="font-size: 24px; line-height: 150px;">Manage Users</h5>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="manage_user_roles.php" class="card text-decoration-none text-center">
                        <div class="card-body bg-info" style="height: 200px;">
                            <h5 class="card-title text-dark" style="font-size: 24px; line-height: 150px;">Manage User Roles</h5>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="manage_suppliers.php" class="card text-decoration-none text-center">
                        <div class="card-body bg-success" style="height: 200px;">
                            <h5 class="card-title text-dark" style="font-size: 24px; line-height: 150px;">Manage Suppliers</h5>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="" class="card text-decoration-none text-center">
                        <div class="card-body bg-warning" style="height: 200px;">
                            <h5 class="card-title text-dark" style="font-size: 24px; line-height: 150px;">Manage Classes</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
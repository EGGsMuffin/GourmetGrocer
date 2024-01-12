<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    $users = $controllers->members()->get_all_members();

    $errormessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $successmessage = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>


<div class="container mt-4">
    <h2 class="text-center py-3">User Management</h2> 
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>User ID</th> 
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>   
                <th>Date Created</th>
                <th>Date Modified</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['ID']) ?></td>
                    <td><?= htmlspecialchars($user['firstname']) ?></td>
                    <td><?= htmlspecialchars($user['lastname']) ?></td> 
                    <td><?= htmlspecialchars($user['email']) ?></td> 
                    <td><?= htmlspecialchars($user['createdOn']) ?></td>
                    <td><?= htmlspecialchars($user['modifiedOn']) ?></td>
                    <td>
                        <div class="row justify-content-center mx-1">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <?php echo "<a href='edit_users.php?id=" . $user["ID"] . "'class='btn btn-warning'>Edit</a>"; ?>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <?php echo "<a href='delete_users.php?id=" . $user["ID"] . "'class='btn btn-danger'>Delete</a>";?>
                            </div>                            
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <section>
        <div class="text-center">
            <div class="justify-content-center align-items-center mx-5 mt-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4">
                        <a href="create_users.php" class="btn btn-primary btn-lg w-100">Create User</a>
                        <?php if($errormessage != null):?>
                            <div class="alert alert-danger mt-4" role="alert">
                                <?= $errormessage ?? '' ?>
                            </div>
                        <?php endif ?>
                        <?php if ($successmessage != null): ?>
                            <div class="alert alert-success mt-4" role="alert">
                                <?= $successmessage ?? '' ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
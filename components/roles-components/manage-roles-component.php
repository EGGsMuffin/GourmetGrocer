<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all role data using the roles controller
    $roles = $controllers->roles()->get_all_roles();

    $errormessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $successmessage = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>


<div class="container mt-4" style="height: 100vh;">
    <h2 class="text-center py-3 ">Role Management</h2> 
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th> 
                <th>Name</th> 
                <th>Date Created</th>
                <th>Date Modified</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <!-- Displays all rows of data in the roles table -->
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= htmlspecialchars($role['id']) ?></td>
                    <td><?= htmlspecialchars($role['name']) ?></td> 
                    <td><?= htmlspecialchars($role['createdOn']) ?></td>
                    <td><?= htmlspecialchars($role['modifiedOn']) ?></td>
                    <td>
                        <div class="row justify-content-center mx-1">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <!-- Takes user to the edit page -->
                                <?php echo "<a href='edit_roles.php?id=" . $role["id"] . "'class='btn btn-warning'>Edit</a>"; ?>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <!-- Takes user to the delete page -->
                                <?php echo "<a href='delete_roles.php?id=" . $role["id"] . "'class='btn btn-danger'>Delete</a>";?>
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
                        <!-- Takes user to the create page -->
                        <a href="create_roles.php" class="btn btn-primary btn-lg w-100">Create Role</a>
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
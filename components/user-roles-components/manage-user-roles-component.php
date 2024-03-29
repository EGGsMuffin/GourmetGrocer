<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all member data using the members controller
    $users = $controllers->members()->get_all_members();

    $errormessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $successmessage = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>

<div class="container mt-4" style="height: 100vh;">
    <h2 class="text-center py-3">User Role Management</h2> 
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>   
                <th>Email</th>
                <th>Roles</th>   
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <!-- Displays all rows of data in the members table -->
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['firstname']) ?></td>
                    <td><?= htmlspecialchars($user['lastname']) ?></td> 
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <?=
                        //Gets the users role
                        $user_id = null;
                        $user_id = $user['ID'];
                        //Gets the role id from the user id
                        $role_id = $controllers->userRoles()->get_role_id_by_user_id($user_id);
                        $id = (int)$role_id['role_id'];
                        //Gets the role name from the role id
                        $role_name = $controllers->roles()->get_role_by_id($id);
                        $name = $role_name['name'];
                        echo htmlspecialchars($name) 
                        ?>
                    </td>
                    <td>
                        <div class="row justify-content-center mx-1">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <!-- Takes user to the edit page -->
                                <?php echo "<a href='edit_user_roles.php?id=" . $user["ID"] . "'class='btn btn-warning'>Edit</a>"; ?>
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
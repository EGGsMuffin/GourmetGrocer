<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all equipment data using the equipment controller
    $roles = $controllers->roles()->get_all_roles();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Roles</h2> 
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Role ID</th> 
                <th>Role Name</th> 
                <th>Date Created</th>
                <th>Date Modified</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?> <!-- Loop through each equipment item -->
                <tr>
                    <td><?= htmlspecialchars($role['id']) ?></td>
                    <td><?= htmlspecialchars($role['name']) ?></td> 
                    <td><?= htmlspecialchars($role['createdOn']) ?></td>
                    <td><?= htmlspecialchars($role['modifiedOn']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
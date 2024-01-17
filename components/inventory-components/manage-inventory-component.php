<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all equipment data using the equipment controller
    $equipment = $controllers->equipment()->get_all_equipments();

    $errormessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $successmessage = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4" style="height: 100vh;">
    <h2>Equipment Inventory</h2> 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?> <!-- Loop through each equipment item -->
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($equip['image']) ?>"
                            alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                            style="width: 100px; height: auto;"> <!-- Display equipment image with escaping for security --> 
                    </td>
                    <td><?= htmlspecialchars($equip['name']) ?></td> 
                    <td><?= htmlspecialchars($equip['description']) ?></td>
                    <td>
                        <div class="row justify-content-center mx-1">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <!-- Takes user to the edit page -->
                                <?php echo "<a href='edit_inventory.php?id=" . $equip["id"] . "'class='btn btn-warning'>Edit</a>"; ?>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                <!-- Takes user to the delete page -->
                                <?php echo "<a href='delete_inventory.php?id=" . $equip["id"] . "'class='btn btn-danger'>Delete</a>";?>
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
                        <a href="create_inventory.php" class="btn btn-primary btn-lg w-100">Create Role</a>
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
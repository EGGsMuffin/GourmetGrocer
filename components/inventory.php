<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all equipment data using the equipment controller
    $equipment = $controllers->equipment()->get_all_equipments();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Equipment Inventory</h2> 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Description</th> 
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
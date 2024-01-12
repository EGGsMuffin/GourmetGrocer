<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    $suppliers = $controllers->suppliers()->get_all_suppliers();

    $errormessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $successmessage = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>


<div class="container mt-4">
    <h2 class="text-center py-3">Suppliers Management</h2> 
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Date Created</th>
                <th>Date Modified</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= htmlspecialchars($supplier['supplier_id']) ?></td>
                    <td><?= htmlspecialchars($supplier['company']) ?></td>
                    <td><?= htmlspecialchars($supplier['contactName']) ?></td>
                    <td><?= htmlspecialchars($supplier['contactEmail']) ?></td>
                    <td><?= htmlspecialchars($supplier['contactPhone']) ?></td>
                    <td><?= htmlspecialchars($supplier['postalCode']) ?></td>
                    <td><?= htmlspecialchars($supplier['country']) ?></td>
                    <td><?= htmlspecialchars($supplier['createdOn']) ?></td>
                    <td><?= htmlspecialchars($supplier['modifiedOn']) ?></td>
                    <td>
                        <div class="row justify-content-center mx-1">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-1">
                                <?php echo "<a href='edit_suppliers.php?id=" . $supplier["supplier_id"] . "'class='btn btn-warning'>Edit</a>"; ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-1">
                                <?php echo "<a href='delete_suppliers.php?id=" . $supplier["supplier_id"] . "'class='btn btn-danger'>Delete</a>";?>
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
                        <a href="create_supplier.php" class="btn btn-primary btn-lg w-100">Create Role</a>
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
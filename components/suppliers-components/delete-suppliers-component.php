<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  //Checks if id is set in the url
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
  }else{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      //Process the submitted form data
      $id = InputProcessor::processString($_POST['id']);

      //Validate all inputs
      $valid = $id['valid'];
      
      //If all inputs are valid, proceed with update
      if ($valid){
        //Prepare the data for update
        $id = (int)$id['value']

        //Deletes the selected supplier's details
        $supplier_deletion = $controllers->suppliers()->delete_supplier($id);
        if ($supplier_update) {
            //Takes the user to the supplier management page with success message
            redirect("manage_suppliers", ["success" => "Supplier has been created!"]);
        } else {
            //Takes the user to the supplier management page with error message
            redirect("manage_suppliers", ["success" => "Supplier Creation Error! Please try again!"]);
        }
      }
    }
    //Takes the user to the user management page with error message
    redirect("manage_users", ["error" => "Connection Timeout"]);
  }
  //Gets the row of data based on id
  $supplier = $controllers->suppliers()->get_supplier_by_supplier_id($id);
?>

<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <section class="vh-750 mt-5">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body px-5 py-3 text-center">
                            <h1 class="mb-3">Supplier Details</h1>
                
                            <div class="form-outline">
                                <label for="id">Id:</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input class="text-center" type="text" name="id" id="id" value="<?php echo $supplier['supplier_id']; ?>" readonly>
                            </div>
                            <div class="form-outline">
                                <label for="company">Company Name:</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input class="text-center" type="text" name="company" id="company" value="<?php echo $supplier['company']; ?>" readonly>
                            </div>
                            <div class="form-outline">
                                <label for="contactName">Contact Name:</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input class="text-center" type="text" name="contactName" id="contactName" value="<?php echo $supplier['contactName']; ?>" readonly>
                            </div>
                            <div class="form-outline">
                                <label for="contactEmail">Contact Email:</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input class="text-center" type="email" name="contactEmail" id="contactEmail" value="<?php echo $supplier['contactEmail']; ?>" readonly>
                            </div>
                            <div class="form-outline">
                            <div class="form-outline">
                                <label for="contactNumber">Contact Number:</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input class="text-center" type="text" name="contactNumber" id="contactNumber" value="<?php echo $supplier['contactPhone']; ?>" readonly>
                            </div>
                            <div class="form-outline">
                                <label for="postcode">Postal Code:</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input class="text-center" type="text" name="postcode" id="postcode" value="<?php echo $supplier['postalCode']; ?>" readonly>
                            </div>
                            <div class="form-outline">
                                <label for="country">Country:</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input class="text-center" type="text" name="country" id="country" value="<?php echo $supplier['country']; ?>" readonly>
                            </div>
            
                            <button class="btn btn-danger btn-lg w-100 mb-4" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
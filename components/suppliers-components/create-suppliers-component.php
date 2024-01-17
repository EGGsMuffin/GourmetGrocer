<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    //Process the submitted form data
    $companyName =  InputProcessor::processString($_POST['company']);
    $contactName =  InputProcessor::processString($_POST['contactName']);
    $contactEmail = InputProcessor::processEmail($_POST['contactEmail']);
    $contactNumber =  InputProcessor::processString($_POST['contactNumber']);
    $postalCode =  InputProcessor::processString($_POST['postcode']);
    $country =  InputProcessor::processString($_POST['country']);

    //Validate all inputs
    $valid = $companyName['valid'] && $contactName['valid'] && $contactEmail['valid'] && $contactNumber['valid']
    && $postalCode['valid'] && $country['valid'];

    //If all inputs are valid, proceed with update
    if ($valid){
      //Checks if company already exists
      $existing_supplier = $controllers->suppliers()->get_supplier_by_company_name($companyName['value']);
      if($existing_supplier){
        //Takes the user to the supplier management page with error message
        redirect("manage_suppliers",["error" => "Company already exists!"]);
      }else{
        //Prepare the data for registration
        $args = ['company' => $companyName['value'],
        'contactName' => $contactName['value'],
        'contactEmail' => $contactEmail['value'],
        'contactPhone' => $contactNumber['value'],
        'postalCode' => $postalCode['value'],
        'country' => $country['value']];

        //Registers the new company
        $supplier = $controllers->suppliers()->register_supplier($args);
        if ($supplier) {
          //Takes the user to the supplier management page with success message
          redirect("manage_suppliers", ["success" => "Member has been created!"]);
        } else {
          //Takes the user to the supplier management page with error message
          redirect("manage_suppliers", ["success" => "Supplier Creation Error! Please try again!"]);
        }
      }
    }
  }
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
                <label for="company">Company Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="company" id="company" placeholder="Enter Company Name" value="" required>
              </div>
              <div class="form-outline">
                <label for="contactName">Contact Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="contactName" id="contactName" placeholder="Enter Contact Name" value="" required>
              </div>
              <div class="form-outline">
                <label for="contactEmail">Contact Email:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="email" name="contactEmail" id="contactEmail" placeholder="Enter Contact Email" value="" required>
              </div>
              <div class="form-outline">
              <div class="form-outline">
                <label for="contactNumber">Contact Number:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="contactNumber" id="contactNumber" placeholder="Enter Contact Number" value="" required>
              </div>
              <div class="form-outline">
                <label for="postcode">Postal Code:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="postcode" id="postcode" placeholder="Enter Postal Code" value="" required>
              </div>
              <div class="form-outline">
                <label for="country">Country:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="text" name="country" id="country" placeholder="Enter Country" value="" required>
              </div>
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
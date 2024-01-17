<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    //Process the submitted form data
    $name =  InputProcessor::processString($_POST['name']);
    $description =  InputProcessor::processString($_POST['description']);
    $image = InputProcessor::processString($_POST['image']);

    //Validate all inputs
    $valid = $name['valid'] && $description['valid'] && $image['valid'];

    //If all inputs are valid, proceed with update
    if ($valid){
      //Checks if item already exists
      $existing_inventory = $controllers->equipment()->get_equipment_by_name($name['value']);
      if($existing_inventory){
        //Takes the user to the inventory management page with error message
        redirect("manage_inventory",["error" => "Inventory already exists!"]);
      }else{
        // Prepare the data for registration
        $args = ['name' => $name['value'],
        'description' => $description['value'],
        'image' => $image['value']];

        //Registers the new item
        $inventory = $controllers->equipment()->create_equipment($args);
        if ($inventory) {
          //Takes the user to the inventory management page with success message
          redirect("manage_inventory", ["success" => "Inventory has been created!"]);
        } else {
          //Takes the user to the inventory management page with error message
          redirect("manage_inventory", ["error" => "Inventory Creation Error! Please try again!"]);
        }
      }
    }
  }
?>

<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100 mt-5">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">
              <h1 class="mb-3">New Inventory Details</h1>
              <div class="form-outline">
                <label for="name">Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="name" id="name" placeholder="Enter inventory name" value="" required>
              </div>
              <div class="form-outline">
                <label for="description">Description:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="description" id="description" placeholder="Enter description" value="" required>
              </div>
              <div class="form-outline">
                <label for="image">Image:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="text" name="image" id="image" placeholder="Enter description" value="" required>
              </div>
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
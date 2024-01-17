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

        //Deletes the selected inventory's details
        $inventory = $controllers->equipment()->delete_equipment($id);
        if ($inventory) {
          //Takes the user to the inventory management page with success message
          redirect("manage_inventory", ["success" => "Inventory has been created!"]);
        } else {
          //Takes the user to the inventory management page with error message
          redirect("manage_inventory", ["error" => "Inventory Creation Error! Please try again!"]);
        }
      }
    }
    //Takes the user to the user management page with error message
    redirect("manage_users", ["error" => "Connection Timeout"]);
  }
  //Gets the row of data based on id
  $inventory = $controllers->equipment()->get_equipment_by_id($id);
?>

<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100 mt-5">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">
              <h1 class="mb-3">Inventory Details</h1>
              <div class="form-outline">
                <label for="id">ID:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="id" id="id" value="<?php echo $inventory['id'] ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="name">Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="name" id="name" value="<?php echo $inventory['name'] ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="description">Description:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="description" id="description" value="<?php echo $inventory['description'] ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="image">Image:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="text" name="image" id="image" value="<?php echo $inventory['image'] ?>" readonly>
              </div>
            
              <button class="btn btn-danger btn-lg w-100 mb-4" type="submit">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
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
      // Process the submitted form data
      $id = InputProcessor::processString($_POST['id']);
      $name =  InputProcessor::processString(strtolower($_POST['name']));
      $modifiedOn =  InputProcessor::processString($_POST['modifiedOn']); 

      // Validate all inputs
      $valid = $id['valid'] && $name['valid'] && $modifiedOn['valid'];

      // If all inputs are valid, proceed with update
      if ($valid){
        //Checks if role already exists
        $existing_role = $controllers->roles()->get_role_by_name($name);
        if($existing_role){
          //Takes the user to the roles management page with error message
          redirect("manage_roles",["error" => "Role already exists!"]);
        }else{
          //Prepare the data for update
          $args = ['id' => $id['value'],
          'name' => $name['value'],
          'modifiedOn' => $modifiedOn['value']];

          //Updates the selected role's details
          $role = $controllers->roles()->update_role($args);
          if ($role) {
            //Takes the user to the roles management page with success message
            redirect("manage_roles", ["success" => "Role has been updated!"]);
          } else {
            //Takes the user to the roles management page with error message
            redirect("manage_roles", ["success" => "Role Edit Error! Please try again!"]);
          }
        }
      }
    }
    //Takes the user to the user roles management page with error message
    redirect("manage_user_roles", ["error" => "Connection Timeout"]);
  }
  //Gets the current date and time
  $currentDateTime = date("Y-m-d H:i:s");
  //Gets the row of data based on id
  $roles = $controllers->roles()->get_role_by_id($id);
?>

<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-750 mt-5">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong mb-5" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">
              <h1 class="mb-3">Role Details</h1>

              <div class="form-outline">
                <label class="mb-2" for="id">Role ID:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="id" id="id" value="<?php echo $roles['id']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="name">Role Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="name" id="name" value="<?php echo $roles['name']; ?>" required>
              </div>
              <div class="form-outline">
                <label for="createdOn">Created On:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="createdOn" id="createdOn" value="<?php echo $roles['createdOn']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="modifiedOn">Modified On:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="text" name="modifiedOn" id="modifiedOn" value="<?php echo $currentDateTime; ?>" readonly>
              </div>
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
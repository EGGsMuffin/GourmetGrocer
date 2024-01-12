<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  $id = (int)$_GET['id'];
  $currentDateTime = date("Y-m-d H:i:s");
  $roles = $controllers->roles()->get_role_by_id($id);
    

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $id = (int)$_POST['id'];
    $name =  strtolower($_POST['name']);
    $modifiedOn =  $_POST['modifiedOn']; 
    
    $existing_role = $controllers->roles()->get_role_by_name($name);
    if($existing_role){
      redirect("manage_roles",["error" => "Role already exists!"]);
    }else{
      // Prepare the data for registration
      $args = ['id' => $id,
      'name' => $name,
      'modifiedOn' => $modifiedOn];

      $role = $controllers->roles()->update_role($args);
      if ($role) {
        redirect("manage_roles", ["success" => "Role has been updated!"]);
      } else {
        $message = "Role Edit Error! Please try again!";
      }
    }
  }
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
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
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
    //Processes the submitted email
    $email = InputProcessor::processEmail($_POST['email']);

    //Gets the user id
    $user_details = $controllers->members()->get_member_by_email($email['value']);
    $user_id = (int)$user_details['ID'];

    //Processes the submitted role
    $role_name = InputProcessor::processString($_POST['role']);
    //Gets the role id
    $role = $controllers->roles()->get_role_by_name((string)$role_name);

    //Checks if user has this role
    $role_id_check = $controllers->userRoles()->get_role_id_by_user_id($user_id);
    if($role['id'] == $role_id_check['role_id']){
      //Takes the user to the user roles management page with error message
      redirect("manage_user_roles", ["error" => "User already has this role!"]);
    }else{
      //Takes the user to the user roles management page with error message
      $user_role_deletion = $controllers->userRoles()->delete_user_role($user_id);

      // Prepare the data for update
      $args = [$user_id,
      $role_id = (int)$role['id']];

      $user_role = $controllers->userRoles()->register_user_role($args);
      if ($user_role) {
        //Takes the user to the user roles management page with success message
        redirect("manage_user_roles", ["success" => "User Role Confirmed!"]);
      } else {
        //Takes the user to the user roles management page with error message
        redirect("manage_user_roles", ["error" => "User Role Edit Error! Please try again!"]);
      }
    }
    //Takes the user to the user roles management page with error message
    redirect("manage_user_roles", ["error" => "Connection Timeout"]);
  }
  }
  //Gets row data based on id
  $user = $controllers->members()->get_member_by_id($id);
  //Gets all roles data
  $roles = $controllers->roles()->get_all_roles();
?>

<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-750 mt-5">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong mb-5" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">
              <h1 class="mb-3">User Role Details</h1>

              <div class="form-outline">
                <label class="mb-2" for="firstname">Firstname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="firstname" id="firstname" value="<?php echo $user['firstname']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="lastname">Lastname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="lastname" id="lastname" value="<?php echo $user['lastname']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="email">Email:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="email" name="email" id="email" value="<?php echo $user['email']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="role_select">Choose an option:</label>
              </div>
              <div class="form-outline mb-4">
                <select name="role" id="role">
                  <!-- Displays all available roles for user -->
                  <?php foreach($roles as $role): ?>
                      <option value="<?php echo $role['name'];?>"><?php echo $role['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
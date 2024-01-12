<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  $currentDateTime = date("Y-m-d H:i:s");

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $firstname =  $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $email =  $_POST['email'];
    $password =  InputProcessor::processPassword($_POST['password'], $_POST['password-v']); 
    
    $existing_user = $controllers->members()->get_member_by_email($email);
    if($existing_user){
      redirect("manage_users",["error" => "User already exists!"]);
    }else{
      // Prepare the data for registration
      $args = ['firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'password' => $password];

      $user = $controllers->members()->register_member($args);

      $user_id = $controllers->members()->get_member_by_email($email);
      $user_id = (int)$user_id['ID'];

      $user_role = ['user_id' => $user_id,
      'role_id' => '7'];

      $role_assigned = $controllers->userRoles()->register_user($user_role);
      if ($user) {
        redirect("manage_users", ["success" => "Member has been created!"]);
      } else {
        $message = "Member Creation Error! Please try again!";
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
              <h1 class="mb-3">User Details</h1>

              <div class="form-outline">
                <label for="firstname">Firstname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="firstname" id="firstname" placeholder="Enter firstname" value="" required>
              </div>
              <div class="form-outline">
                <label for="lastname">Lastname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="lastname" id="lastname" placeholder="Enter lastname" value="" required>
              </div>
              <div class="form-outline">
                <label for="email">Email:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="email" name="email" id="email" placeholder="Enter email" value="" required>
              </div>
              <div class="form-outline">
                <label for="password">Password:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="password" name="password" id="password" placeholder="Enter password" value="" required>
              </div>
              <div class="form-outline">
                <label for="password-v">Confirm Password:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="password" name="password-v" id="password-v" placeholder="Confirm password" value="" required>
              </div>
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
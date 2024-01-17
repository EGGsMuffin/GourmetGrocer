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
      $firstname = InputProcessor::processString($_POST['firstname']);
      $lastname = InputProcessor::processString($_POST['lastname']);
      $email = InputProcessor::processEmail($_POST['email']);
      $password = InputProcessor::processPassword($_POST['password'], $_POST['password-v']);
      $modifiedOn = InputProcessor::processString($_POST['modifiedOn']);

      // Validate all inputs
      $valid = $id['valid'] && $firstname['valid'] && $lastname['valid'] && $email['valid'] && $password['valid'] && $modifiedOn['valid'];

      // If all inputs are valid, proceed with update
      if ($valid){
        // Prepare the data for update
        $args = ['id' => (int)$id['value'],
        'firstname' => $firstname['value'],
        'lastname' => $lastname['value'],
        'email' => $email['value'],
        'password' => password_hash($password['value'], PASSWORD_DEFAULT),
        'modifiedOn' => $modifiedOn['value']];
          
        //Updates the selected user's details
        $user = $controllers->members()->update_member($args);
        if ($user) {
          //Takes the user to the user management page with success message
          redirect("manage_users", ["success" => "User has been updated!"]);
        } else {
          //Takes the user to the user management page with error message
          redirect("manage_users", ["error" => "User Edit Error! Please try again!"]);
        }
      }
    }
    //Takes the user to the user management page with error message
    redirect("manage_users", ["error" => "Connection Timeout"]);
  }

  //Gets the current time and date
  $currentDateTime = date("Y-m-d H:i:s");
  //Gets the row of data based on the id
  $users = $controllers->members()->get_member_by_id($id);
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
                <label class="mb-2" for="id">User ID:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="id" id="id" value="<?php echo $users['ID']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="firstname">Firstname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="firstname" id="firstname" value="<?php echo $users['firstname']; ?>" required>
              </div>
              <div class="form-outline">
                <label for="lastname">Lastname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="lastname" id="lastname" value="<?php echo $users['lastname']; ?>" required>
              </div>
              <div class="form-outline">
                <label for="email">Email:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="email" name="email" id="email" value="<?php echo $users['email']; ?>" required>
              </div>
              <div class="form-outline">
                <label for="password">Password:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="password" name="password" id="password" placeholder="Enter Password" value="" required>
              </div>
              <div class="form-outline">
                <label for="password-v">Confirm Password:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="password" name="password-v" id="password-v" placeholder="Confirm Password" value="" required>
              </div>
              <div class="form-outline">
                <label for="createdOn">Created On:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="createdOn" id="createdOn" value="<?php echo $users['createdOn']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="modifiedOn">CModified On:</label>
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
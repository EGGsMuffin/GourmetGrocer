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
        $id = (int)$id['value'];

        //Deletes the selected user's details
        $user_role_deletion = $controllers->userRoles()->delete_user_role($id);
        $user_deletion = $controllers->members()->delete_member($id);
        if ($user_deletion) {
          //Takes the user to the user management page with success message
          redirect("manage_users", ["success" => "User has been deleted!"]);
        } else {
          //Takes the user to the user management page with error message
          redirect("manage_users", ["error" => "User Deletion Error! Please try again!"]);
        }
      }
    }
    //Takes the user to the user management page with error message
    redirect("manage_users", ["error" => "Connection Timeout"]);
  }
  //Gets the row of data based on id
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
                <input class="text-center" type="text" name="firstname" id="firstname" value="<?php echo $users['firstname']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="lastname">Lastname:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="lastname" id="lastname" value="<?php echo $users['lastname']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="email">Email:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="email" name="email" id="email" value="<?php echo $users['email']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="createdOn">Created On:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="createdOn" id="createdOn" value="<?php echo $users['createdOn']; ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="modifiedOn">Modified On:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="text" name="modifiedOn" id="modifiedOn" value="<?php echo $users['modifiedOn']; ?>" readonly>
              </div>
            
              <button class="btn btn-danger btn-lg w-100 mb-4" type="submit">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
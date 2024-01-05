<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // Process the submitted form data
  $fname = InputProcessor::processString($_POST['fname']);
  $sname =  InputProcessor::processString($_POST['sname']);
  $email =  InputProcessor::processEmail($_POST['email']);
  $password =  InputProcessor::processPassword($_POST['password'], $_POST['password-v']);
  
  // Validate all inputs
  $valid = $fname['valid'] && $sname['valid'] && $email['valid'] && $password['valid'];

  // Set an error message if any input is invalid
  $message = !$valid ? "Please fix the above errors:" : '';

  // If all inputs are valid, proceed with registration
  if ($valid)
  {
    // This Checks for if the email has already been set up with an account
    $existing_member = $controllers->members()->get_member_by_email($email['value']);
    if($existing_member){
      // Set error message if is email is already used
      $message = "Email already registered.";
    }else{
      // Prepare the data for registration
      $args = ['firstname' => $fname['value'],
      'lastname' => $sname['value'],
      'email' => $email['value'],
      'password' => password_hash($password['value'], PASSWORD_DEFAULT)];

      // Register the member
      $member = $controllers->members()->register_member($args);
      if ($member) {
      // Redirect to login page on successful registration
      redirect("index", ["error" => "Please login with your new account"]);
      } else {
      // Set error message if the user registraion fails
      $message = "Registration Error! Please try again!";
      }
    }
  }
}
?>

<!-- HTML form for registration -->
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100 mt-5">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong mb-5" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">

              <h3 class="mb-3">Register</h3>
              <p>Please enter your details (Use your work email)</p>
              <div class="form-outline mb-4">
                <input required type="text" id="fname" name="fname" class="form-control form-control-lg" placeholder="Firstname" value="<?= htmlspecialchars($fname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($fname['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="sname" name="sname" class="form-control form-control-lg" placeholder="Surname" value="<?= htmlspecialchars($sname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($sname['error'] ?? '') ?></small>
              </div>


              <div class="form-outline mb-4">
                <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" value="<?= htmlspecialchars($email['value']?? '') ?>" />
                <small class="text-danger"><?= htmlspecialchars($email['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" />
              </div>
              
              <div class="form-outline mb-4">
                <input required type="password" id="password-v" name="password-v" class="form-control form-control-lg" placeholder="Password again" />
                <small class="text-danger"><?= htmlspecialchars($password['error'] ?? '') ?></small>
              </div>

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register</button>
              <a class="btn btn-secondary btn-lg w-100" type="submit" href="./index.php" >Already got an account?</a>

              <?php if ($message): ?>
                <div class="alert alert-danger mt-4">
                  <?= $message ?? '' ?>
                </div>
              <?php endif ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
<?php
// Start the session to maintain user state
session_start();
// Clear all session variables
session_unset(); 

// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize variables for message, email, and password
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$email = null;
$password = null;

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Process the submitted email and password
    $email = InputProcessor::processEmail($_POST['email']);
    $password = InputProcessor::processPassword($_POST['password']);

    // Check if both email and password are valid
    $valid = $email['valid'] && $password['valid'];

    // If valid, attempt to log in the member
    if ($valid) {
  
      // Call the login function from the member controller
      $member = $controllers->members()->login_member($email['value'], $password['value']);

      // Check if login was successful
      if (!$member) {
        // Set error message if login failed
        $message = "User details are incorrect.";
     } else {
         // Set user session data on successful login
         $_SESSION['user'] = $member;

         // Redirect based on user type
         if ($member['user_type'] === 'admin') {
          redirect('.\Inventory.php'); // Redirect admin users
      } else {
          redirect('member'); // Redirect non-admin users
      }
      }

    }
    else {
       // Set error message for invalid input
       $message =  "Please fix the above errors. ";
   }

} 
?>

<!-- HTML form for login -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <!-- Form content -->
  <section class="vh-75 mt-2">
    <div class="container py-5 h-75 text-center">
      <h4>Welcome to the Online Gourmet Grocer Inventory System</h4>
      <p class="mb-4">Login in with your Gourmet Grocer account to look at the inventory details</p>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">
  
              <h3 class="mb-3">Sign in</h3>
              <!-- Email input field -->
              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?= htmlspecialchars($email['value'] ?? '') ?>"/>
                  <!-- Display error message for email -->
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>
  
              <!-- Password input field -->
              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required value="<?= htmlspecialchars($password['value'] ?? '') ?>"/>
                  <!-- Display error message for password -->
                  <span class="text-danger"><?= $password['error'] ?? '' ?></span>
                </div>
  
              <!-- Submit button -->
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Login</button>
              <!-- Link to registration page -->
              <a class="btn btn-secondary btn-lg w-100" type="submit" href="./register.php" >Not got an account?</a>
              <div class="mt-3">
                <a href="password-reset.php">Forgotten your password</a>
              </div>
              
              <!-- Display message if set -->
              <?php while($message != null):?>
                <?php if ($message == "Please login with your new account"): ?>
                  <div class="alert alert-success mt-4" role="alert">
                    <?= $message ?? '' ?>
                  </div>
                <?php else:   ?>
                  <div class="alert alert-danger mt-4" role="alert">
                    <?= $message ?? '' ?>
                  </div>
                <?php endif ?>
              <?php endwhile ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

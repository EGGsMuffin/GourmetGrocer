<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    //Process the submitted form data
    $categoryName = InputProcessor::processString($_POST['CategoryName']);
    $description =  InputProcessor::processString($_POST['Description']);
    
    //Validate all inputs
    $valid = $categoryName['valid'] && $description['valid'];

    //If all inputs are valid, proceed with update
    if ($valid){
      //Checks if category already exists
      $existing_category = $controllers->categories()->get_category_by_category_name($categoryName['value']);
      if($existing_category){
        //Takes the user to the category management page with success message
        redirect("manage_categories",["error" => "Category already exists!"]);
      }else{
        // Prepare the data for registration
        $args = ['CategoryName' => $categoryName['value'],
        'Description' => $description['value']];

        //Registers the new category
        $category = $controllers->categories()->register_category($args);
        if ($category) {
          //Takes the user to the category management page with success message
          redirect("manage_categories", ["success" => "Role has been created!"]);
        } else {
          //Takes the user to the category management page with error message
          redirect("manage_categories", ["error" => "Category Creation Error! Please try again!"]);
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
          <div class="card shadow-2-strong mb-5" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">
              <h1 class="mb-3">New Category Details</h1>
              <div class="form-outline">
                <label for="CategoryName">Category Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="CategoryName" id="CategoryName" placeholder="Enter category name" value="" required>
              </div>
              <div class="form-outline">
                <label for="Description">Description:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="Description" id="Description" placeholder="Enter description" value="" required>
              </div>
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
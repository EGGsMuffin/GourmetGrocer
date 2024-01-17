<?php
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  //Checks if id is set in the url
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
  }else{
    //Process the submitted form data
    $categoryID = InputProcessor::processString($_POST['CategoryID']);
    $categoryName =  InputProcessor::processString($_POST['CategoryName']);
    $description =  InputProcessor::processString($_POST['Description']); 

    //Validate all inputs
    $valid = $categoryID['valid'] && $categoryName['valid'] && $description['valid'];

    //If all inputs are valid, proceed with update
    if ($valid){
      //Prepare the data for update
      $args = ['CategoryID' => $categoryID['value'],
      'CategoryName' => $categoryName['value'],
      'Description' => $description['value']];

      //Updates the selected category's details
      $category = $controllers->categories()->update_category($args);
      if ($category) {
        //Takes the user to the categories management page with success message
        redirect("manage_categories", ["success" => "Category has been edited!"]);
      } else {
        //Takes the user to the categories management page with error message
        redirect("manage_categories", ["error" => "Category Edit Error! Please try again!"]);
      }
    }
    //Takes the user to the category management page with error message
    redirect("manage_users", ["error" => "Connection Timeout"]);
  }
  //Get the row of data based on the id
  $category = $controllers->categories()->get_category_by_category_id($id);
?>

<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100 mt-5">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body px-5 py-3 text-center">
              <h1 class="mb-3">Category Details</h1>
              <div class="form-outline">
                <label for="CategoryID">Category ID:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="CategoryID" id="CategoryID" value="<?php echo $category['CategoryID'] ?>" readonly>
              </div>
              <div class="form-outline">
                <label for="CategoryName">Category Name:</label>
              </div>
              <div class="form-outline mb-2">
                <input class="text-center" type="text" name="CategoryName" id="CategoryName" value="<?php echo $category['CategoryName'] ?>" required>
              </div>
              <div class="form-outline">
                <label for="Description">Description:</label>
              </div>
              <div class="form-outline mb-4">
                <input class="text-center" type="text" name="Description" id="Description" value="<?php echo $category['Description'] ?>" required>
              </div>
            
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
<?php $isLoggedIn = isset($_SESSION['user']);?>

<?php   
    if(isset($_POST['logout'])) {
      session_unset();
      header("Location:index.php?showPopup=true");
      exit();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title><?php echo $title ?? "Gourmet Grocer" ?></title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- If the user is logged in then they need to login to see more -->
      <?php if ($isLoggedIn): ?>
        <a class="navbar-brand" href="./menu.php">Online Inventory</a>
      <?php else: ?>
        <a class="navbar-brand" href="./index.php">Online Inventory</a>
      <?php endif; ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- If the user is logged in then they need to login to see more -->
          <?php if ($isLoggedIn): ?>
            <li class="nav-item active">
                <a class="nav-link" href="./profile.php">Profile</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="./menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./manage_inventory.php">Equipment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./manage_roles.php">Roles</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./manage_users.php">Users</a>
              </li>
            </ul>
            <div class="ml-auto">
              <form method="post">
                <input class="p-2 px-3" id="logout_button" type="submit" name="logout" value="Logout">
              </form>
            </div>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="./index.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./register.php">Register</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </body>
</html>
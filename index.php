<?php require __DIR__ . "/inc/header.php";?>

<?php require __DIR__ . "/components/login-form.php"; ?>

<?php
    if (isset($_GET['showPopup']) && $_GET['showPopup'] === 'true') {
        echo '<script type="text/javascript">';
            echo 'setTimeout(function() {';
                echo 'alert("Logout Successful!");';
            echo '}, 500);';
        echo '</script>';
    }
?>

<?php require __DIR__ . "/inc/footer.php"; ?>
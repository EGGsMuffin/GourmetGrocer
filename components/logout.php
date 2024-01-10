<?php
    session_start();

    function redirect($page, array $params = [])
    {
        $qs = $params ? '?' . http_build_query($params) : '';
        header("Location:$page" . $qs);
        exit;
    }
    
    if(isset($_POST['logout'])) {
        session_unset();
        echo "Logged out successfully";
        redirect('../index.php');
        exit();
    } else {
        echo "Invalid request - Log out unsuccessful";
        redirect('../member.php');
    }
?>
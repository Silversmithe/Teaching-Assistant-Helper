<?PHP
    session_start();

    $_SESSION["user-type"] = "Student";
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["session"] = $_POST["pin"];
    
    /* Verify Student Identity via session */
    
    
    // possibly want a token here instead
    $_SESSION["login-valid"] = true;
    // go to the app page now
    header("Location: app.php");
    exit();
?>
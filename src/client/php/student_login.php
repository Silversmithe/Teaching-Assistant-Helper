<?PHP
    session_start();

    $_SESSION["user-type"] = "Student";
    $_SESSION["uname"] = $_POST["uname"];
    $_SESSION["session-pin"] = $_POST["session-pin"];
    
    /* Verify Student Identity via session */
    
    
    // possibly want a token here instead
    $_SESSION["login-valid"] = true;
    // go to the app page now
    header("Location: app.php");
    exit();
?>
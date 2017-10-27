<?PHP
    session_start();

    $_SESSION["user"] = "student";
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["session"] = $_POST["session"];
    
    // go to the app page now
    header("Location: app.php");
    exit();
?>
<?PHP
    session_start();

    // User information
    $_SESSION["user"] = "Teaching Assistant";
    $_SESSION["name"] = $_POST["username"];

    $password = $_POST["password"];

    /* Verify user and re-route to session */

    // possibly want a token instead
    $_SESSION["login-valid"] = true;
    // redirect
    header("Location: session.php");
    exit();
?>
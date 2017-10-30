<?PHP
    session_start();

    // User information
    $_SESSION["user-type"] = "Teaching Assistant";
    $_SESSION["uname"] = $_POST["uname"];

    $password = $_POST["pass"];

    /* Verify user and re-route to session */

    // possibly want a token instead
    $_SESSION["login-valid"] = true;
    // redirect
    header("Location: session.php");
    exit();
?>
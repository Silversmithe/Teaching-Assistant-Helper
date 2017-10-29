<?PHP
    $name = $_POST["name"]
    $username = $_POST["uname"];
    $pass = $_POST["password"];
    $pass_confirm = $_POST["confirm-password"];
    $auth_code = $_POST["auth-code"];

    /* Code section to register teaching assistant */
    // check to make sure $auth_code is CORRECT

    // create a space in the database for the teaching assistant

    header("Location: ../index.php");
    exit();
?>
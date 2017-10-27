<?PHP
    $name = $_POST["name"];
    $pass = $_POST["password"];
    $auth_code = $_POST["auth_code"];

    header("Location: app.php");
    exit();
?>
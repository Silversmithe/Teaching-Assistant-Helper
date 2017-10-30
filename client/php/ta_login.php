<?PHP
    session_start();
	$_SESSION["login-valid"] = false;
    // User information
    $_SESSION["user-type"] = "Teaching Assistant";
    $_SESSION["username"] = $_POST["username"];
    $pass = $_POST["password"];

    /* Verify user and re-route to session */

	$dbhost = "dbserver.engr.scu.edu";
	$servername = "sdb_shoff";
	$username = "shoff";
	$password = "00001072205";


	// Create connection
	$conn = mysqli_connect($dbhost, $username, $password, $servername)
        or die("Error" . mysqli_error($conn));

	$login = $conn->query("SELECT * FROM TAs WHERE username = " . "'" . $_SESSION["username"] . "'" . " AND password = " . "'" . $pass . "'");
	
	if(($login != false) and (mysqli_num_rows($login) != 0 )){
		$_SESSION["login-valid"] = true;
	} else{
		header("Location: logout.php");
		exit();
	}
    // possibly want a token instead
	$_SESSION["name"] = mysqli_fetch_assoc($login)["name"];
    // redirect
    header("Location: session.php");
    exit();
?>

<html>
	<?PHP echo "|" . $pass . "|"; ?>
	<?PHP echo "|" . $_SESSION["username"] . "|"; ?>
	<?PHP echo "|" . $_SESSION["name"] . "|"; ?>
</html>

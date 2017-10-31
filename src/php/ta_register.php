<?PHP
    $name = $_POST["name"];
    $uname = $_POST["uname"];
    $pass = $_POST["password"];
    $pass_confirm = $_POST["confirm-password"];
    $auth_code = $_POST["auth-code"];
	
	$true_code = 12345;

	if($auth_code != $true_code){
		header("Location: logout.php");
		exit();
	}

	if($pass != $pass_confirm){
		header("Location: logout.php");
		exit();
	}
	
    /* Code section to register teaching assistant */

	$dbhost = "dbserver.engr.scu.edu";
	$servername = "sdb_shoff";
	$username = "shoff";
	$password = "00001072205";


	// Create connection
	$conn = mysqli_connect($dbhost, $username, $password, $servername)
        or die("Error" . mysqli_error($conn));
	
	$conn->query("INSERT INTO TAs (name, username, password) VALUES ('" . $name . "', '" . $uname . "', '" . $pass . "')");

    // check to make sure $auth_code is CORRECT

    // create a space in the database for the teaching assistant

    header("Location: ../index.php");
    exit();
?>

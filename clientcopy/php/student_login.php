<?PHP
    session_start();
	/*Verify that Name and pin are set */
	$_SESSION["login-valid"] = false;
	if (strlen($_POST["name"]) > 0 and strlen($_POST["pin"]) > 0){
	} else {
		header("Location: logout.php");
		exit("Must enter a name and session number.");
	}
	
    $_SESSION["user-type"] = "Student";
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["session-pin"] = $_POST["pin"];

	$dbhost = "dbserver.engr.scu.edu";
	$servername = "sdb_shoff";
	$username = "shoff";
	$password = "00001072205";


	// Create connection
	$conn = mysqli_connect($dbhost, $username, $password, $servername)
        or die("Error" . mysqli_error($conn));


	
	$session = $conn->query("SELECT session_id FROM Sessions WHERE session_id = " . $_SESSION["session-pin"]);
	if(($session != false) and mysqli_num_rows($session) != 0){
		$_SESSION["login-valid"] = true;
	}
    if($_SESSION["login-valid"] == false){
		header("Location: logout.php");
		exit("invalid session id");

	}



    // possibly want a token here instead
	// Student has been validated at this point
    $insrt = $conn->prepare("INSERT INTO Students (session_id, name) VALUES (?, ?)");
	$insrt->bind_param("is", $pin, $name);
	$pin = $_SESSION["session-pin"];
	$name = $_SESSION["name"];
	$insrt->execute();
    // go to the app page now
	$result = $conn->query("SELECT * FROM Sessions WHERE session_id = " . $_SESSION["session-pin"]);
	$_SESSION["lab-name"] = mysqli_fetch_assoc($result)["title"];
    header("Location: app.php");
    exit();
?>

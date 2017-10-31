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

    $sessions = $conn->query("SELECT session_id FROM Sessions WHERE session_id = " . $_SESSION["session-pin"]);
	if(($sessions != false) and mysqli_num_rows($sessions) != 0){
		$_SESSION["login-valid"] = true;
	}
    if($_SESSION["login-valid"] == false){
		header("Location: logout.php");
		exit("invalid session id");

	}
    // possibly want a token here instead
	// Student has been validated at this point
    $conn->query("INSERT INTO Students (session_id, name) VALUES (" . $_SESSION["session-pin"] . ", '" . $_SESSION["name"] . "')");
    // go to the app page now
	$title = $conn->query("SELECT * FROM Sessions WHERE session_id = " . $_SESSION["session-pin"]);
	$_SESSION["lab-name"] = mysqli_fetch_assoc($title)["title"];
    header("Location: app.php");
    exit();
?>

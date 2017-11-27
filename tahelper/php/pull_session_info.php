<?PHP
    require('object.php');
    session_start();

    // gather information from the database
    // ACTUAL THING

    $QAs = array();
    $As = array();
	$QAID = 0;
	$AID = 0;
    
    // logging in
    
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];

        $dbhost = "dbserver.engr.scu.edu";
		$servername = "sdb_shoff";
		$username = "shoff";
		$password = "00001072205";

		// Create connection
     	$conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
		
		switch($action){
		
		case 'pull_qa':
			// pulling the questions and answers
			$pin = $_POST["pin"];

			// Verify the session exists
			$session = $conn->query("SELECT * FROM Sessions WHERE session_id=" . $pin);
			if(($session == false) or mysqli_num_rows($session) == 0) {
				echo false;
				exit();
			}

			$questions = $conn->query("SELECT * FROM QA WHERE session_id = " . $pin);
			while($row = mysqli_fetch_assoc($questions)){
				array_push($QAs, new QAObject("qa" . $QAID, $row["time"], $row["student_name"], $row["question"], $row["answer"]));
				$QAID = $QAID+1;
			}

			// STORE ARRAYS IN SESSION VARIABLES 
			$_SESSION["QAs"] = $QAs;

			// convert Questions and answers to JSON 
			$QA_JSON = "[";
		
			for($i=0; $i < count($_SESSION["QAs"]); $i++){
				$QA_JSON = $QA_JSON . json_encode($_SESSION["QAs"][$i]);
				if($i+1 >= count($_SESSION["QAs"])){
				    break;
				} else {
				    $QA_JSON = $QA_JSON . ", ";
				}
			}

			$QA_JSON = $QA_JSON . "]";

			// send JSON
			echo $QA_JSON;
			break;

		case 'pull_a':
			// pulling the announcements
			$pin = $_POST["pin"];

			// Verify the session exists
			$session = $conn->query("SELECT * FROM Sessions WHERE session_id=" . $pin);
			if(($session == false) or mysqli_num_rows($session) == 0) {
				echo false;
				exit();
			}

			$announcements = $conn->query("SELECT * FROM Announcements WHERE session_id = " . $pin);
			while($row = mysqli_fetch_assoc($announcements)){
				array_push($As, new AObject("a" . $AID, $row["announcement"]));
				$AID = $AID+1;
			}

			// STORE ARRAYS IN SESSION VARIABLES 
			$_SESSION["As"] = $As;

			// convert Announcements to JSON
			$A_JSON = "[";
		
			for($i=0; $i < count($_SESSION["As"]); $i++){
				$A_JSON = $A_JSON . json_encode($_SESSION["As"][$i]);
				if($i+1 >= count($_SESSION["As"])){
				    break;
				} else {
				    $A_JSON = $A_JSON . ", ";
				}
			}

			$A_JSON = $A_JSON . "]";

			// push JSON
			echo $A_JSON;
			break;
		}
	}

?>

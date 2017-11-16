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
    
    
    $dbhost = "dbserver.engr.scu.edu";
    $servername = "sdb_shoff";
    $username = "shoff";
    $password = "00001072205";
                
    // Create connection
     $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
	
	// pulling questions
    $questions = $conn->query("SELECT * FROM QA WHERE session_id = " . $_SESSION["session-pin"]);
    while($row = mysqli_fetch_assoc($questions)){
        array_push($QAs, new QAObject($QAID, $row["time"], $row["student_name"], $row["question"], $row["answer"]));
		$QAID = $QAID+1;
    }

	// pulling announcements
	$announcements = $conn->query("SELECT * FROM Announcements WHERE session_id = " . $_SESSION["session-pin"]);
    while($row = mysqli_fetch_assoc($announcements)){
        array_push($As, new AObject($AID, $row["announcement"]));
		$AID = $AID+1;
    }


    // STORE ARRAYS IN SESSION VARIABLES 
    $_SESSION["QAs"] = $QAs;
    $_SESSION["As"] = $As;


    // end fake DB transfer
    // should have QA's in an array and A's in another array

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

    // pass the information back to the client
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            // pull all question information
            case 'pull_qa' : 
                echo $QA_JSON;
                break;
                
            // pull all Announcement information
            case 'pull_a':
                echo $A_JSON;
                break;
        }
    }   


?>

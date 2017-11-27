<?PHP
    require('object.php');
    session_start();

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];

        $dbhost = "dbserver.engr.scu.edu";
		$servername = "sdb_shoff";
		$username = "shoff";
		$password = "00001072205";
        
        switch($action) {
            case 'push_qa_response':
                // upload information to database
                $qaID = $_POST["qaID"];
                $answer = $_POST["answer"];
                                
                $QA = null;
                
                // find the session variable you need
                for($i=0; $i < count($_SESSION["QAs"]); $i++){
                    $qa = $_SESSION["QAs"][$i];
                    
                    if($qa->id == $qaID){
                        // change the values in the array
                        $qa->answer = $answer;
                        $QA = $qa;
                        break;
                    }
                }

                if($QA != null){
                    // change the database with $QA	           
					// update database
					$conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
					$stmt = $conn->query("UPDATE QA SET answer='" . $QA->answer . "' WHERE student_name='" . $QA->name . "' AND question='" . $QA->question . "';");
                } 
    
                break;
                
            case 'push_qa':
                $name = $_POST["name"];
				$pin = $_POST["pin"];
                $question = $_POST["question"];
                $answer = null;
                
				// Create connection
				$conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
				$stmt = $conn->prepare("INSERT INTO QA (session_id, student_name, question) VALUES(?, ?, ?)");
				$stmt->bind_param("iss", $session_pin, $student_name, $student_question);
				$session_pin = $pin;
				$student_name = $name;
				$student_question = $question;
				$stmt->execute();
                break;
                
            case 'push_a':
				$pin = $_POST["pin"];
                $announcement = $_POST["announcement"];

				// Create connection
				$conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
				$stmt1 = $conn->prepare("INSERT INTO Announcements (session_id, announcement) VALUES(?, ?)");
				$stmt1->bind_param("is", $session_pin, $announce_prep);
				$session_pin = $pin;
				$announce_prep = $announcement;
				$stmt1->execute();
                // create a new entry in the database
                break;
        }

    }

?>

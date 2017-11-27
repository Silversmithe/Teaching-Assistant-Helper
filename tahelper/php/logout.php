<?PHP
	session_start();
	/* User Information Removal & Retrieval */
	
	/* Student */
    //exits current session

	/* Teaching Assistant */
	// copies announcements, QA and puts them into file
	// download file


    //If TA logs out, session is deleted from database, can save session as text file
    if($_POST["type"] == "ta"){
        //create and open file to write to
        $myFile = "lab" . $_POST["pin"] . ".txt";
        $output = fopen($myFile, 'w') or die("can't open file");


        //info to connect to database
        $dbhost = "dbserver.engr.scu.edu";
        $servername = "sdb_shoff";
        $username = "shoff";
        $password = "00001072205";
                
        // Create connection
        $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));

        //get all questions
        $questions = $conn->query("SELECT * FROM QA WHERE session_id = " . $_POST["pin"]);
        //get announcements
        $ann = $conn->query("SELECT * FROM Announcements WHERE session_id = " . $_POST["pin"]);
        
        //put mySQL into a text file
        //write session info here
        fwrite($output, "Session info " . $_POST["pin"] . "\n\n");
        
        //Write announcements to file
        fwrite($output, "Announcements:\n__________________________________\n");
        
        while($row = mysqli_fetch_assoc($ann)){
            $stringData = $row["announcement"] . "\n\n";
            fwrite($output, $stringData);
        }
        

        //Write questions and answers to file
        fwrite($output, "\nQuestions: \n__________________________________\n");    
        
        while($row = mysqli_fetch_assoc($questions)){
            $stringData = $row["time"] . "\n" . $row["student_name"] . ": " . $row["question"] . "\n" . "TA: " . $row["answer"] . "\n\n";
            fwrite($output, $stringData);
        }

        //close file, finished writing
        fclose($output);
        
        // with respect to the CURRENT created section
        // removes announcements info from Announcements db
        $conn->query("DELETE FROM Announcements WHERE session_id =" . $_POST["pin"]);
        
        // removes questions info from QA db
        $conn->query("DELETE FROM QA WHERE session_id = " . $_POST["pin"]);
        
        // removes session info from Sessions db 
        $conn->query("DELETE FROM Sessions WHERE session_id =" . $_POST["pin"]);
    
    }


    /* Destroy Session Variables */
    session_unset();
    session_destroy();

	/* Re-directing to index */
    exit();
?>


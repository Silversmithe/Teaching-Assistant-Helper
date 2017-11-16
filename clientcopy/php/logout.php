<?PHP
	session_start();
	/* User Information Removal & Retrieval */
	
	/* Student */
	// removing information from student database
	// removing information from QA database

	/* Teaching Assistant */
	// copies announcements, QA and puts them into file
	// download file

    //create file to write to
    $myFile = "testFile.txt";
    $fo = fopen($myFile, 'w') or die("can't open file");



    //$data_query=mysql_query("SELECT name,age from table");

    //while($data=mysql_fetch_array($data_query))


    // logging in
   if($_SESSION["user-type"] == "Teaching Assistant"){
    
    $dbhost = "dbserver.engr.scu.edu";
    $servername = "sdb_shoff";
    $username = "shoff";
    $password = "00001072205";
                
    // Create connection
     $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));

    //get all questions
    $questions = $conn->query("SELECT * FROM QA WHERE session_id = " . $_SESSION["session-pin"]);

    while($row = mysqli_fetch_assoc($questions)){
        $stringData= $row["time"]."\n" . $row["student_name"] . ": " . $row["question"] . "\n" . $row["answer"] . "\n\n";
        fwrite($fo, $stringData);
    }

    
    
    //$stringData = 'Some test text yay\n';
    fwrite($fo, $stringData);

    fclose($fo);


    //download file assuming it writes correctly
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($myFile).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($myFile));
    readfile($myFile);
}


	// with respect to the CURRENT created section
	// removes announcements info from Announcements db
	// removes questions info from QA db
	// removes session info from Sessions db

    /* Destroy Session Variables */
    session_unset();
    session_destroy();

	/* Re-directing to index */
    header("Location: ../index.php");
    exit();
?>

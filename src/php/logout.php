<?PHP
	session_start();
	/* User Information Removal & Retrieval */
	
	/* Student */
	// removing information from student database
	// removing information from QA database

	/* Teaching Assistant */
	// copies announcements, QA and puts them into file
	// download file

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


<?PHP 

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        if ($_POST['action'] == 'create_session'){
            if(strlen($_POST["lab_name"]) > 0){
		        // set the session variable for lab name
		        // this means that this script is called for form submission
		        $lab_name = $_POST["lab_name"];
                $uname_val = $_POST["uname"];

		        /* Register Session In Database */
		        $dbhost = "dbserver.engr.scu.edu";
		        $servername = "sdb_shoff";
		        $username = "shoff";
		        $password = "00001072205";

		        // Create connection
		        $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));


		        // insert session into the session database
		        $stmt = $conn->prepare("INSERT INTO Sessions (username, title) VALUES (?, ?)");
				$stmt->bind_param("ss", $uname, $title);
				$uname = $uname_val;
				$title = $lab_name;
				$stmt->execute();
				
				//get id for unique pin number
				$result = $conn->query("SELECT * FROM Sessions WHERE title = '" . $lab_name . "';");
                echo mysqli_fetch_assoc($result)["session_id"];
		        exit();
			} else {
                echo false;
                exit();
            }
        }
    }
?>

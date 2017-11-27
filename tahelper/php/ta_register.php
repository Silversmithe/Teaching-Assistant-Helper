<?PHP
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        if ($_POST['action'] == 'create_ta'){
            $name = $_POST["name"];
            $uname = $_POST["uname"];
            $pass = $_POST["pass"];
            $pass_confirm = $_POST["pass_confirm"];
                  
            if($pass != $pass_confirm){
                echo false;
                exit();
            }
			
			 
			$to = "shoff@scu.edu";
			$subject = "TA Confirmation";
			$body = "Should " . $name . " be registered as a TA? Details: Name = " . $name . ", Username =  " . $uname . ", Password =  " . $pass
				 . "<html>
				<body><p><a href=\"students.engr.scu.edu/~shoff/testse/client/php/admin.php?valid=12469282084859790929\">Redirect </a></p></body>
				</html>";
			$headers = 'MIME-Version: 1.0' . "\r\n";			
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			mail($to, $subject, $body, $headers);

			
            /* Code section to register teaching assistant */

            $dbhost = "dbserver.engr.scu.edu";
            $servername = "sdb_shoff";
            $username = "shoff";
            $password = "00001072205";

            // Create connection
            $conn = mysqli_connect($dbhost, $username, $password, $servername)
                or die("Error" . mysqli_error($conn));

            $pass = hash("sha256", $pass);

            $stmt = $conn->prepare("INSERT INTO TAs (name, username, password, validate) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $TAname, $TAuname, $TApassword, $TAvalidate);
            $TAname = $name;
            $TAuname = $uname;
            $TApassword = $pass;
			$TAvalidate = 0;
            $stmt->execute();

            // check to make sure $auth_code is CORRECT

            // create a space in the database for the teaching assistant

            echo true;
            exit();
        }
    }
?>

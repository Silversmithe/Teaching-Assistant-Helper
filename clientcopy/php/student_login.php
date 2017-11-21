<?PHP
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        if ($_POST['action'] == 'log_student'){
            
            // make sure it is not completely empty
            if (!(strlen($_POST["name"]) > 0 and strlen($_POST["pin"]) > 0)){
                echo false;
                exit();
            }
            
            // attempt actual registration
            $user_type = "Student";
            $name_val = $_POST["name"];
            $pin_val = $_POST["pin"];
            /*Verify that Name and pin are set */
	        $login_valid = false;

            $dbhost = "dbserver.engr.scu.edu";
            $servername = "sdb_shoff";
            $username = "shoff";
            $password = "00001072205";


            // Create connection
            $conn = mysqli_connect($dbhost, $username, $password, $servername)
                or die("Error" . mysqli_error($conn));

            $session = $conn->query("SELECT session_id FROM Sessions WHERE session_id = " . $pin_val);
            if(($session != false) and mysqli_num_rows($session) != 0){
                $login_valid = true;
            }
            
            if($login_valid == true){
                // possibly want a token here instead
                // Student has been validated at this point
                $insrt = $conn->prepare("INSERT INTO Students (session_id, name) VALUES (?, ?)");
                $insrt->bind_param("is", $pin, $name);
                $pin = $pin_val;
                $name = $name_val;
                $insrt->execute();
                
                // go to the app page now
                $result = $conn->query("SELECT * FROM Sessions WHERE session_id = " . $pin_val);
                echo mysqli_fetch_assoc($result)["title"];
                exit();
            }
            echo false;
        }
    }
?>

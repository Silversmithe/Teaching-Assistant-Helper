<?PHP
    session_start();

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        if ($_POST['action'] == 'log_ta'){
            // make sure it is not completely empty
            if (!(strlen($_POST["uname"]) > 0 and strlen($_POST["pass"]) > 0)){
                echo false;
                exit();
            }
        
            /*Verify that Name and pin are set */
	        $login_valid = false;
            // User information
            $uname_val = $_POST["uname"];
            $pass_val = $_POST["pass"];

            /* Verify user and re-route to session */
            $dbhost = "dbserver.engr.scu.edu";
            $servername = "sdb_shoff";
            $username = "shoff";
            $password = "00001072205";


            // Create connection
            $conn = mysqli_connect($dbhost, $username, $password, $servername)
                or die("Error" . mysqli_error($conn));

            $pass_val = hash("sha256", $pass_val);
            $login = $conn->query("SELECT * FROM TAs WHERE username = " . "'" . $uname_val . "'" . " AND password = " . "'" . $pass_val . "' AND validate = 1");

            if(($login != false) and (mysqli_num_rows($login) != 0 )){
                $login_valid = true;
            } 
            
            if($login_valid == true){
                // possibly want a token instead
				$obj = (object) array(mysqli_fetch_assoc($login)["name"]);
                echo json_encode($obj);
                exit();
            }
            echo false;
        } // end ta login
    } // end post
?>

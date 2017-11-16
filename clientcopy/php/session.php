<?PHP 
    session_start();
    $allset=false;

    if(!isset($_SESSION["login-valid"]) || $_SESSION["login-valid"] == false){
        // redirect to index
        header("Location: logout.php");
        exit();
    }
    
    // Store form into session
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // only run this portion when post has been set
      
			if(strlen($_POST["lab-name"]) > 0){
		        // set the session variable for lab name
		        // this means that this script is called for form submission
		        $_SESSION["lab-name"] = $_POST["lab-name"];

		        
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
				$uname = $_SESSION["username"];
				$title = $_SESSION["lab-name"];
				$stmt->execute();
				
				//get id for unique pin number
				$result = $conn->query("SELECT * FROM Sessions WHERE title = '" . $_SESSION["lab-name"] . "';");
				$_SESSION["session-pin"] = mysqli_fetch_assoc($result)["session_id"];

		        /* Re-route to application */
		        header("Location: app.php");
		        exit();
			}
       
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Session Creation</title>
    </head>

    <body>
    	<div id="border">

	    <p style="font-size: 24px;">Lab Session Creation</p>
        <p> Welcome, <?PHP echo $_SESSION["name"]; ?></p>
	    <hr>

	    <div id="create-session" style="padding: 5%;">
        
            <form id="new-session" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                Session Name: <input type="text" name="lab-name" value="lab_name"/>
                <br><br>
                <input type="submit" value="(+) Create Session" />
            </form>
            <br><br>
            <form action="logout.php" method="post">
                <input type="submit" value="Log Out" />
            </form>

	    </div>
	    
	    <hr>    
	</div>

    </body>


</html>

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
        if(!isset($_SESSION["lab-name"])){
            // set the session variable for lab name
            // this means that this script is called for form submission
            $_SESSION["lab-name"] = $_POST["lab-name"];
            $allset=true;
        } else { $allset=false; }

        if(!isset($_SESSION["session-pin"])){
            // set the session variable for 
            // this means that this script is called for form submission
            $_SESSION["session-pin"] = $_POST["session-pin"];
            $allset=1;
        } else { $allset=false; }

        if($allset == 1){
            
            /* Register Session In Database */
            $dbhost = "dbserver.engr.scu.edu";
            $servername = "sdb_shoff";
            $username = "shoff";
            $password = "00001072205";

            // Create connection
            $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));

            // insert session into the session database
            $conn->query("INSERT INTO Sessions (sessions_id, username, title) VALUES (" . $_SESSION["session-pin"] . ", " . $_SESSION["username"] . ", " . $_SESSION["lab-name"] ")");
            
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
        <p> Welcome, <?PHP echo $_SESSION["uname"]; ?></p>
	    <hr>

	    <div id="create-session" style="padding: 5%;">
        
            <form id="new-session" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                Session Name: <input type="text" name="lab-name" value="lab_name"/>
                <br><br>
                PIN:  <input type="text" name="session-pin" value="pin" />
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
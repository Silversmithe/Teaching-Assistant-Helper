<?PHP 
    session_start();
    /* Reroutes clients that are not logged in */
    if(!isset($_SESSION["login-valid"]) || $_SESSION["login-valid"] == false){
        // redirect to index
        header("Location: logout.php");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // this is when the user presses the "send" button
        if(isset($_POST["question"]) and strlen($_POST["question"]) > 0){
			$dbhost = "dbserver.engr.scu.edu";
            $servername = "sdb_shoff";
            $username = "shoff";
            $password = "00001072205";
            
            // Create connection
            $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
        
            // pull all questions
            $conn->query("INSERT INTO QA (session_id, student_name, question) VALUES ('" . $_SESSION["session-pin"] . "', '" . $_SESSION["name"] . "', '" . $_POST["question"] . "')");
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
    	<title>TAQH: Main Application</title>
	<link rel="stylesheet" 	type="text/css" href="css/app.css">
    </head>
    
    <body>
        
        <div>
            <b style="font-size: 24px;"><?PHP echo $_SESSION["lab-name"]; ?></b>
            <br><br>
            <i><?PHP echo $_SESSION["user-type"]; ?></i>
            <p>Welcome, <i><?PHP echo $_SESSION["name"]; ?></i></p>
            <p>PIN: <i><?PHP echo $_SESSION["session-pin"]; ?></i></p>
            
            <form action="logout.php" method="post">
                <input type="submit" value="Log Out" />
            </form>

            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <input type="submit" value="Refresh" />
            </form>
            <hr>
        </div>
        
        
        <div id="forum" style="width: 100%; background-color: lightgray;">
            <?PHP
                // logging in
                
                $dbhost = "dbserver.engr.scu.edu";
                $servername = "sdb_shoff";
                $username = "shoff";
                $password = "00001072205";
                
                // Create connection
	            $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
            
                // pull all questions
                $questions = $conn->query("SELECT * FROM QA WHERE session_id = " . $_SESSION["session-pin"]);
            
                while($row = mysqli_fetch_assoc($questions)){
                    echo "<br>";
                    echo $row["time"];
                    echo "<br>";
                    echo $row["student_name"] . ": " . $row["question"];
                    echo "<br>";
                    echo "(A): " . $row["answer"];
                    echo "<br><hr>";
                }
            ?>
        </div>
        
        <div id="footer">
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <input type=text name="question" style="width: 85%; height: 40px; font-size: 18px;"/> 
                <input id="send" type="submit" value="send" style="width: 10%; height: 40px;"/>
            </form>
        </div>
        
    </body>
    
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/app.js"></script>
</html>

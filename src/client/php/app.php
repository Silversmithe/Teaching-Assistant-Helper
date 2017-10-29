<?PHP 
    session_start();
    /* Reroutes clients that are not logged in */
    if(!isset($_SESSION["login-valid"])){
        // redirect to index
        header("Location: logout.php");
        exit();
    } 

    if(!isset($_SESSION["questions"])){
        $_SESSION["questions"] = array();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // this is when the user presses the "send" button
        array_push($_SESSION["questions"], $_POST["question"]);
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
        </div>
        
        <form action="logout.php" method="post">
            <input type="submit" value="Log Out" />
        </form>
        <hr>
        
        <div id="forum" style="width: 100%; height: 100%; background-color: lightgray;">
            <?PHP
                $length=count($_SESSION["questions"]);
                for($x = 0; $x < $length; $x++) {
                    echo $_SESSION["questions"][$x];
                    echo "<br><br>";
                }
            ?>
        </div>
        
        <div id="footer">
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <input type=text name="question" style="width: 85%; height: 40px; font-size: 18px;"/> 
                <input type="submit" value="send" style="width: 10%; height: 40px;"/>
            </form>
        </div>
        
    </body>
</html>
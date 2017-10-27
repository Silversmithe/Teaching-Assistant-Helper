<?PHP
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    

    <head>
    	<title>TAQH: Main Application</title>
	<link rel="stylesheet" 	type="text/css" href="css/app.css">
    </head>
    
    <body>
    	
    <p>Main Application</p>

    <p>Type: <?PHP echo $_SESSION["user"]; ?></p>
    <p>Welcome, <?PHP echo $_SESSION["name"]; ?></p>
	<p>CLASSNAME #: Class LABNUMBER</p>
    <p>Session ID: <?PHP echo $_SESSION["session"]; ?></p>
    
    <form action="logout.php" method="post">
        <input type="submit" value="Log Out" />
    </form>
	<hr>

		
    </body>
</html>
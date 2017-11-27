<?PHP
    // make sure that they have a field for validation
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if(isset($_GET["valid"])){
		    // make sure that their code is correct
		    $pass = 12469282084859790929;
		    if($_GET["valid"] != $pass){
		        // send them back
		        header("Location: ../index.php");
		    }
		} else {
		    // send them the frizzle back
		    header("Location: ../index.php");
		}
	}

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // update information on server        
        // now go ahead and update the validation
        $name = $_POST["name"];
        $uname = $_POST["uname"];
        $pass = $_POST["pass"];
        $pass_confirm = $_POST["pass_confirm"];  
        
        if($pass != $pass_confirm){ exit(); }
        
        $dbhost = "dbserver.engr.scu.edu";
        $servername = "sdb_shoff";
        $username = "shoff";
        $password = "00001072205";

        // Create connection
        $conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
        
        $pass = hash("sha256", $pass);
        
/*
        $stmt = $conn->prepare("UPDATE TAs SET validate=1 WHERE name=?, username=?, password=?");
        $stmt->bind_param("sss", $TAname, $TAuname, $TApassword);
        $TAname = $name;
        $TAuname = $uname;
        $TApassword = $pass;
        $stmt->execute();
*/
		echo $name . " : " . $uname . " : " . $pass;

        $stmt = $conn->query("UPDATE TAs SET validate=1 WHERE "
						. "name='" . $name
						. "' AND username='" . $uname
						. "' AND password='" . $pass . "';");  
	} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    
    <head>
        <title>Admin</title>
    </head>
    
    <body style="padding: 5%;">
    	<br>
    	<h3>Teaching Assistant Registration</h3>
    	<hr>
    	<i>Please re-enter the TA's information in the email</i>
    	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
		Name: <input id="ta-name" type="text" name="name" />
		<br><br>
		Username: <input id="ta-uname" type="text" name="uname" />
		<br><br>
		Password: <input id="ta-new-pass" type="password" name="pass"/>
		<br><br>
		Confirm Password: <input id="ta-pass-check" type="password" name="pass_confirm" />
		<br><br>
		<button type="submit">Submit</button>
		<br><br>
    	</form>      
    </body>

</html>

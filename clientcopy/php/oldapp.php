<?PHP 
    session_start();
    /* Reroutes clients that are not logged in */
    if(!isset($_SESSION["login-valid"]) || $_SESSION["login-valid"] == false){
        // redirect to index
        header("Location: logout.php");
        exit();
    }


//this will go in push_session_info
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
            $stmt = $conn->prepare("INSERT INTO QA (session_id, student_name, question) VALUES (?, ?, ?)");
			$stmt->bind_param("iss", $pin, $student, $question);
			$pin = $_SESSION["session-pin"];
			$student = $_SESSION["name"];
			$question = $_POST["question"];
			$stmt->execute();
        }
    } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    
    <head>
    	<title>TA Question Helper: App</title>
		<link rel="stylesheet" 	type="text/css" href="../css/app.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    
    <body>

		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			  </button>
			  <a class="navbar-brand" href="#">COEN McJesus</a>
			</div>
			<div class="collapse navbar-collapse" id="Navbar">
			  <ul class="nav navbar-nav navbar-right">
				<li><a onclick="alert('refresh');" href="javascript:void(0);"><span></span> Refresh</a></li>
				<li><a onclick="alert('logout');" href="javascript:void(0);"><span></span> Logout</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
       
		<div class="row">
			<div class="col-xs-12">
				<div id="app-nav">
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
			</div>
		</div>

		<div class="row">
			<div class="col-xs-6">
				<div id="app-forum">
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
			</div>
			<div class="col-xs-6">
				<div id="app-announce">
					<?PHP
						$dbhost = "dbserver.engr.scu.edu";
		            	$servername = "sdb_shoff";
		            	$username = "shoff";
		            	$password = "00001072205";
						$conn = mysqli_connect($dbhost, $username, $password, $servername) or die("Error" . mysqli_error($conn));
		         
		                // pull all questions
		                $announcements = $conn->query("SELECT * FROM Announcements WHERE session_id = " . $_SESSION["session-pin"]);
		                while($row = mysqli_fetch_assoc($announcements)){
		                    echo "<br>";
		                    echo $row["announcement"];
		                    echo "<br><hr>";
							echo "hello there";
						}
					?>
					<p>Hello there </p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div id="app-footer">
					<form action="<?PHP echo $_SERVER['PHP_SELF'];?>" method="post">
						<div class="input-group">
							<input type="text" class="form-control input-lg" placeholder="Type a Message..." name="question">
							<div class="input-group-btn">
								<button class="btn btn-default btn-lg" type="submit">Send</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
        
    </body>
    
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/app.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</html>

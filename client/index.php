<!DOCTYPE html>
<html lang="en">

    <head>
        <title>TA Question Helper: Main</title>
        
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    
    <body>
        
        <div id="border">
            
            <div id="title-space">
                <p id="title">Teaching Assistant Question Helper</p>
                <br>
                <i id="prompt">I am a ...</i>
                <br>
            </div>

            <div id="selection">
                <button class="select" id="student-btn" type="button"><b>STUDENT</b></button>
                <br><br>
                <button class="select" id="ta-btn" type="button"><b>TEACHING ASSISTANT</b></button>
		<br><br>
		<button id="register" type="button"><b>REGISTER</b></button>
            </div>

            <div id="forms">
                <form id="student-form" action="php/student_login.php" method="post">
                    <p>Student</p>
                    <hr>
        
                    Name: <input id="name" type="text" name="name" value="John Doe"/>
                    <br>
                    <br>
                    Session ID: <input id="session" type="text" name="session" value="passphrase" />
                    <br>
                    <br>
                    <input type="submit" />
                </form>
                
                <form id="ta-form" action="php/session.php" method="post">
                    <p>Teaching Assistant</p>
                    <hr>
        
                    Username: <input type="text" value="" name="username" />
                    <br>
                    <br>
                    Password: <input type="password" />
                    <br>
                    <br>
                    <input type="submit" />
                </form>
    		
		<form id="ta-register" action="php/ta_register.php" method="post">
		    <p>Teaching Assistant Registration</p>
		    <hr>
		    
		    Username: <input type="text" name="username" />
		    <br><br>
		    Password: <input type="password" name="password"/>
		    <br><br>
		    Confirm Password: <input type="password" />
		    <br><br>
	            Authorization Code: <input type="password" name="auth_code"/>
    		    <br><br>
		    <input type="submit" />		    
		</form>

                <br>
                <button id="cancel">Back</button>
		<br>
	 	<p id="status"> Extra information goes here... </p>
	    </div>
        
        </div>
        
    </body>
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/index.js"></script>

</html>

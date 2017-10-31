<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

            <div id="select-space">
                <button class="select" id="student-btn" type="button"><b>STUDENT</b></button>
                <br><br>
                <button class="select" id="ta-btn" type="button"><b>TEACHING ASSISTANT</b></button>
                <br><br>
                <button id="register" type="button"><b>REGISTER</b></button>
            </div>

            <div id="form-space">
                <form id="student-form" action="php/student_login.php" method="post">
                    <p>Student</p>
                    <hr>
                    Name: <input type="text" name="name" value=""/>
                    <br><br>
                    PIN: <input type="text" name="pin" value="" />
                    <br><br>
                    <input type="submit" value="Submit" />
                </form>
                
                <form id="ta-form" action="php/ta_login.php" method="post">
                    <p>Teaching Assistant</p>
                    <hr>
                    Username: <input type="text" value="" name="username" />
                    <br><br>
                    Password: <input type="password" name="password"/>
                    <br><br>
                    <input type="submit" value="Submit" />
                </form>
    		
		        <form id="ta-register" action="php/ta_register.php" method="post">
                    <p>Teaching Assistant Registration</p>
                    <hr>
                    Name: <input type="text" name="name" />
                    <br><br>
                    Username: <input type="text" name="uname" />
                    <br><br>
                    Password: <input type="password" name="password"/>
                    <br><br>
                    Confirm Password: <input type="password" name="confirm-password" />
                    <br><br>
                        Authorization Code: <input type="password" name="auth-code"/>
                        <br><br>
                    <input type="submit" value="Submit" />		    
                </form>

                <br>
                <button id="cancel">Back</button>
				<br>

		 		<p id="status"> Status information goes here... </p>
			</div>
        </div>
    </body>
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/index.js"></script>
</html>

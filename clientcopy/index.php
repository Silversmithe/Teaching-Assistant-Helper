<!DOCTYPE html>
<html lang="en">

    <head>
        <title>TA Question Helper: Main</title>
        
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    
    <body>
        <div id="border" class="container container-fluid">

            <div id="title-space" class="row">
                <div class="col-xs-12">
                    <h2>Teaching Assistant Question Helper</h2>
                    <br>
                    <i>I am a ...</i>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div id="selection">
                        <button class="select" id="student-btn" class="btn btn-default" type="button">Student</button>
                        <br><br>
                        <button class="select" id="ta-btn" class="btn btn-default" type="button">Teaching Assistant</button>
                        <br><br>
                        <button id="register" class="btn btn-default" type="button">Register</button>
                    </div>
                </div>
            </div>

            <div class="row">  
                <div class="col-xs-2 col-lg-2"></div>
                <div id="forms" class="col-xs-8 col-lg-8"> 
                    
                    <form id="student-form" class="form-style" action="php/student_login.php" method="post">
                        <br>
                        <h3>Student</h3>
                        <hr>
                        Name: <input type="text" name="name" value=""/>
                        <br><br>
                        PIN: <input type="text" name="pin" value="" />
                        <br><br>
                        <input type="submit" class="btn btn-default" value="Submit" />
                        <br><br>
                    </form>

                    <form id="ta-form" class="form-style" action="php/ta_login.php" method="post">
                        <br>
                        <h3>Teaching Assistant</h3>
                        <hr>
                        Username: <input type="text" value="" name="username" />
                        <br><br>
                        Password: <input type="password" name="password"/>
                        <br><br>
                        <input type="submit" class="btn btn-default" value="Submit" />
                        <br><br>
                    </form>

                    <form id="ta-register" class="form-style" action="php/ta_register.php" method="post">
                        <br>
                        <h3>Teaching Assistant Registration</h3>
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
                        <input type="submit" class="btn btn-default" value="Submit" />
                        <br><br>
                    </form>

                    <br>
                    <button id="cancel" class="btn btn-default btn-lg">Back</button>
                    <br>
                </div>
                <div class="col-xs-2 col-lg-2"></div>
            </div>

        </div>
    </body>
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>

</html>

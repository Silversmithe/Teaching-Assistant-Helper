<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Session Creation</title>
        <link rel="stylesheet" type="text/css" href="../css/session.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <body>
    	<div id="border" class="container container-fluid">

            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    <div id="lab-creation">
                        <h2>Lab Session Creation</h2>
                        <h3 id="welcome-user"></h3>
                        <hr>
                        <div id="create-session" style="padding: 5%;">
                            Session Name: <input id="lab-name" type="text" name="lab-name" />
                            <br><br>
                            <button id="create-btn" type="button" class="btn btn-primary">Create Session</button>
                        </div>
                        <br><hr><br>
                        <form action="logout.php" method="post">
                            <button type="submit" class="btn btn-default">Log Out</button>
                        </form>
                    </div>
                </div>
                <div class="col-xs-2"></div>   
            </div>  
	   </div>
    </body>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/session.js"></script>
</html>

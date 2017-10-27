<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Session Creation</title>
    </head>

    <body>
    	<div id="border">

	    <p style="font-size: 24px;">USERNAME: Lab Session Creation</p>
	    <hr>

	    <div id="create-session" style="padding: 5%;">
        
            <form id="new-session" action="app.php" method="post">
                Session Name: <input type="text" name="name" />
                <br><br>
                Session Pin:  <input type="text" name="session" />
                <br><br>
                <input type="submit" value="(+) Create Session" />
            </form>

	    </div>
	    
	    <hr>    
	</div>

    </body>


</html>
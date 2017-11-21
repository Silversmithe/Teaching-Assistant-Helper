<?PHP
	session_start();
    /* Reroutes clients that are not logged in */
//    if(!isset($_SESSION["login-valid"]) || $_SESSION["login-valid"] == false){
//        // redirect to index
//        header("Location: logout.php");
//        exit();
//    }

//    $_SESSION["user-type"] = "Student";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // update information on server        
        
    } 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    
    <head>
    	<title>TA Question Helper</title>
		<link rel="stylesheet" 	type="text/css" href="../css/app.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>    
    
    <body>
        <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <span id="lab-user-name" class="navbar-brand" onclick="toggleAnnounce();" href="javascript:void(0);"></span>
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                  </button>
                </div>
                <div class="collapse navbar-collapse" id="Navbar">
                  <ul class="nav navbar-nav navbar-right">
                    <li id="announce-btn"><a >Toggle View</a></li>
                    <li><a>Refresh</a></li>
                    <li><a>Logout</a></li>
                  </ul>
                </div>
              </div>
            </nav>

        <div class="global">
            <div class="global-container container-fluid">
                <div class="row-fluid">
                    <div class="col-xs-12">
                        <div id="app-nav" class="container">
                            <p id="welcome-title"></p>
                            <p id="pin-info"></p>
                            <?PHP
                                if(isset($_SESSION["user-type"]) && $_SESSION["user-type"] == "Teaching Assistant"){
                                    if(isset($_SESSION["session-pin"])){
                                        echo "<p>PIN: " . $_SESSION["session-pin"] . "</p>";
                                    } else {
                                        echo "<p>PIN: no session pin found </p>";
                                    }
                                }
                            ?>

							<form action="logout.php" method="post">
						    	<button class="btn btn-default" type="submit" >Logout </button>
							</form>

							<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
						    	<button class="btn btn-default" type="submit" >Refresh</button>
							</form>
                            <hr>
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div id="qa" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3>Questions and Answers</h3>
                        <hr>
                        <div id="app-forum" class="forum-area"></div>
                        <hr>
                        <div class="message-bar">
                            <form action="<?PHP echo $_SERVER['PHP_SELF'];?>" method="post">
                                <div class="input-group">
                                    <input id="qa-bar" type="text" class="form-control input-lg" placeholder="Type a Message..." name="question">
                                    <div class="input-group-btn">
                                        <button id="send-question" class="btn btn-default btn-lg" type="button">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>    
                    </div>

                    <div id="announce" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h3>Announcements</h3>
                        <hr>
                        <div id="app-announce" class="forum-area"></div>
                        <hr>
                        <div class="message-bar">
                            <form action="<?PHP echo $_SERVER['PHP_SELF'];?>" method="post">
                                <div class="input-group">
                                    <input id="a-bar" type="text" class="form-control input-lg" placeholder="Type an Announcement..." name="announcement">
                                    <div class="input-group-btn">
                                        <button id="send-announcement" class="btn btn-default btn-lg" type="button">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                     </div>
                </div> 
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <blockquote id="student-question"></blockquote>
                    <form id="response-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <textarea id="ta-answer" name="ta-answer"></textarea>
                        <input id="qID" name="qID"/>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="modal-close btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="response-submit" type="button" class="btn btn-primary">Submit</button>
                    </div>
              </div>
            </div>
          </div>
        </div>
        
    </body>
    
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/app.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    
</html>

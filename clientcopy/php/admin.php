<?PHP

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    
    <body style="padding: 5%;">
        <div class="container container-fluid">
            <h3>Admin Page</h3>
            <hr>
            <div id="important-info">
                Teaching Assistant Registration Key: <i>12345</i>
                <br><br>
                <button>Change Registration Key</button>
            </div>
            <br><br>
            <form action="logout.php" method="post">
                <button type="submit" >Logout</button>
            </form>       
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
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    Username: <input name="uname"/>
                    <br>
                    Password:<input name="password"/>
                    <br>
                    <button type="submit" class="btn btn-default">Enter</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </body>
    
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        // prompt the user with a modal once ready
        $(document).ready(function(){
            $("#myModal").modal("show");
        });
    </script>

</html>
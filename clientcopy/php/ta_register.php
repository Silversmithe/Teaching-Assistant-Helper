<?PHP
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        if ($_POST['action'] == 'create_ta'){
            $name = $_POST["name"];
            $uname = $_POST["uname"];
            $pass = $_POST["pass"];
            $pass_confirm = $_POST["pass_confirm"];
            $auth = $_POST["auth"];

            // !!! need to change
            $true_code = 12345;
            if($auth != $true_code){
                echo false;
                exit();
            }
            if($pass != $pass_confirm){
                echo false;
                exit();
            }

            /* Code section to register teaching assistant */

            $dbhost = "dbserver.engr.scu.edu";
            $servername = "sdb_shoff";
            $username = "shoff";
            $password = "00001072205";

            // Create connection
            $conn = mysqli_connect($dbhost, $username, $password, $servername)
                or die("Error" . mysqli_error($conn));

            $pass = hash("sha256", $pass);

            $stmt = $conn->prepare("INSERT INTO TAs (name, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $TAname, $TAuname, $TApassword);
            $TAname = $name;
            $TAuname = $uname;
            $TApassword = $pass;
            $stmt->execute();

            // check to make sure $auth_code is CORRECT

            // create a space in the database for the teaching assistant

            echo true;
            exit();
        }
    }
?>

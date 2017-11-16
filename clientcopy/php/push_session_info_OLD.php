<?PHP
    require('object.php');
    session_start();

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        $id = $_POST['qaID'];
        
        switch($action) {
            case 'push_qa':
                
                // upload information to database
                $qaID = $_POST["qaID"];
                $answer = $_POST["answer"];
//                echo $qaID . " : " . $answer;
                                
                $QA = null;
                // find the session variable you need
//                echo " :" . count($_SESSION["QAs"]);
                
                for($i=0; $i < count($_SESSION["QAs"]); $i++){
                    $qa = $_SESSION["QAs"][$i];
                    echo get_class($qa) . " ";
                }
//                foreach ($_SESSION["QAs"] as $qa){
//                    
//                    
//                    if($qa->id == $id){
//                        // change the values in the array
//                        echo "reached";
//                        $qa->answer = $answer;
//                        $QA = $qa;
//                        break;
//                    }
//                }

//                if($QA != null){
//                    // change the database 
//                    echo ': changed ' . $QA->id;
//                } else {
//                    echo ': changed nothing';
//                }
    
                break;
        }

    }

?>
<?PHP
    require('object.php');
    session_start();

    // gather information from the database

        // TEST ANNOUNCEMENT
        $id2 = 0;
        $timestamp2 = "8:00AM";
        $name2 = "Professor Farnsworth";
        $announcement2 = "Good news everyone! NO class today!";

        // SETUP TEST INFO
        $id = 0;
        $time = "11:00AM";
        $name = "Alex Adranly";
        $question = "Why is the sky blue?";
        $answer = "I am not really sure...";

        $id1 = 1;
        $time1 = "11:01AM";
        $name1 = "Laila Adranly";
        $question1 = "Why is the Earth round?";
        $answer1 = null;

        // ACTUAL THING

        $QAs = array();
        $As = array();
    
        // add all the Questions and answers
        array_push($QAs, new QAObject($id, $time, $name, $question, $answer));
        array_push($QAs, new QAObject($id1, $time1, $name1, $question1, $answer1));

        // add all the Announcements
        array_push($As, new AObject($id2, $timestamp2, $name2, $announcement2));

    // STORE ARRAYS IN SESSION VARIABLES 
    $_SESSION["QAs"] = $QAs;
    $_SESSION["As"] = $As;


    // end fake DB transfer
    // should have QA's in an array and A's in another array

    // convert Questions and answers to JSON 
    $QA_JSON = "[";
    
    for($i=0; $i < count($_SESSION["QAs"]); $i++){
        $QA_JSON = $QA_JSON . json_encode($_SESSION["QAs"][$i]);
        if($i+1 >= count($_SESSION["QAs"])){
            break;
        } else {
            $QA_JSON = $QA_JSON . ", ";
        }
    }

    $QA_JSON = $QA_JSON . "]";

    // convert Announcements to JSON
    $A_JSON = "[";
    
    for($i=0; $i < count($_SESSION["As"]); $i++){
        $A_JSON = $A_JSON . json_encode($_SESSION["As"][$i]);
        if($i+1 >= count($_SESSION["As"])){
            break;
        } else {
            $A_JSON = $A_JSON . ", ";
        }
    }

    $A_JSON = $A_JSON . "]";

    // pass the information back to the client
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            // pull all question information
            case 'pull_qa' : 
                echo $QA_JSON;
                break;
                
            // pull all Announcement information
            case 'pull_a':
                echo $A_JSON;
                break;
        }
    }   


?>
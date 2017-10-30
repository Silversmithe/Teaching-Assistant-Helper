<?PHP
    session_start();
    /* Download File */
    $my_file = $_SESSION["lab-name"] . ".txt";
    $log_file = fopen($my_file , 'w') or die("Unable to open file!");

    $test_script = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    
    fwrite($log_file, $test_script);

    fclose($log_file);

    
    

    /* Destroy Session Variables */
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
?>
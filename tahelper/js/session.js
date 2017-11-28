/*
    session.js
    November 27th, 2017
    
    Handle any server calls on the session.php page
    - create new lab sessions that TAs can run and 
    students can join
*/

/* ==== PAGE INITIALIZATION ==== */
$(document).ready(function(){
    /*
        When the page is loaded, load the 
        USER's personal information and 
        prompt them to create a new session
    */
    
    // should do a check to see if user is valid
    if(sessionStorage.getItem("user-valid") != true){
        location.replace("../index.php");
    }
    
    $welcome_string = "Welcome, ";
    var name = sessionStorage.getItem("user-name");
    
    if(name != null){
        $welcome_string = $welcome_string + name;
    } else {
        $welcome_string = $welcome_string + "Unknown User";
    }
    
    $("#welcome-user").text($welcome_string);
});

/* ==== FORM HANDLING ==== */
$("#create-btn").click(function(){
    /*
        When the CREATE SESSION button is pressed
        take the text information and use it to create a session
    */
    $lab_name = $("#lab-name").val();
    $uname = sessionStorage.getItem("user-uname");
        
    $.ajax({ url: '../php/create_session.php',
         data: {action: 'create_session', lab_name: $lab_name, uname: $uname},
         type: 'post',
         success: function(output) {
             // if output is not false, it is true
             if(output != false){
                // if true, initialize everything
                // output should be lab-pin if NOT false
                sessionStorage.setItem("lab-pin", output);
                sessionStorage.setItem("lab-name", $lab_name);
                 
                // move to the next page
                location.assign("../php/app.php");
             } else {
                 alert("invalid session entry");
             }
         }
    });
});

/* ==== LOGOUT ==== */
$("#logout").click(function(){
    /*
        On the logout button, just redirect the TA
        back to the main page. Do not need to pass
        through the logout
    */
    location.replace("../index.php");
});

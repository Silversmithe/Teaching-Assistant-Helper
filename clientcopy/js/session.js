/*
    session.js
    
    Handle any ajax calls
*/

$(document).ready(function(){
    // should do a check to see if user is valid
//    if(sessionStorage.getItem("user-valid") != true){
//        location.replace("../index.php");
//    }
    
    $welcome_string = "Welcome, ";
    var name = sessionStorage.getItem("name");
    
    if(name != null){
        $welcome_string = $welcome_string + name;
    } else {
        $welcome_string = $welcome_string + "Unknown User";
    }
    
    $("#welcome-user").text($welcome_string);
});

$("#create-btn").click(function(){
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
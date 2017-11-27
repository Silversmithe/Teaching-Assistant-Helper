/**
    index.js
    
    The client-side code for index.php
*/

$("#student-btn").click(function(){
    $("#selection").hide();
    $("#student-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
    $("#forms").show();
});

$("#submit-student").click(function(){
    $name = $("#student-name").val();
    $pin = $("#student-pin").val();
    
    $.ajax({ url: 'php/student_login.php',
         data: {action: 'log_student', name: $name, pin: $pin},
         type: 'post',
         success: function(output) {
             // if output is not false, it is true
             if(output != false){
                // if true, initialize everything
                sessionStorage.setItem("user-type", "student");
                sessionStorage.setItem("user-name", $name);
                sessionStorage.setItem("user-uname", $name);
                sessionStorage.setItem("user-valid", true);
                sessionStorage.setItem("lab-pin", $pin);
                sessionStorage.setItem("lab-name", output);
                 
                // move to the next page
                location.assign("php/app.php");
             } else {
                alert("login unsucessful");
             }
         } 
    });
});

$("#ta-btn").click(function(){
    $("#selection").hide();
    $("#ta-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
    $("#forms").show();
});

$("#submit-ta").click(function(){
    $uname = $("#ta-name").val();
    $pass = $("#ta-pass").val();
        
    $.ajax({ url: 'php/ta_login.php',
         data: {action: 'log_ta', uname: $uname, pass: $pass},
         type: 'post',
         success: function(output) {
             // if output is not false, it is true
             if(output != false){
                 // output = JSON {name:---, uname: ----}			
                var result = JSON.parse(output);
	
                // if true, initialize everything
                sessionStorage.setItem("user-type", "ta");
                sessionStorage.setItem("user-name", result[0]);
                sessionStorage.setItem("user-uname", $uname);
                sessionStorage.setItem("user-valid", true);
                sessionStorage.setItem("lab-pin", null);
                sessionStorage.setItem("lab-name", null);
                 
                // move to the next page
                location.assign("php/session.php");
             } else {
                 alert("login unsucessful");
             } 
         }
    });
});

$("#cancel").click(function(){
    $("#forms").hide();
    $("#ta-form").css({"visibility": "hidden", "display": "none"});
    $("#student-form").css({"visibility": "hidden", "display": "none"});
    $("#ta-register").css({"visibility": "hidden", "display": "none"});
    $("#cancel").css({"visibility": "hidden", "display": "none"});
    $("#selection").show();
});

$("#register").click(function(){
    $("#selection").hide();
    $("#ta-form").css({"visibility": "hidden", "display": "none"});
    $("#student-form").css({"visibility": "hidden", "display": "none"});
    $("#ta-register").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
    $("#forms").show();
});

$("#register-ta").click(function(){
    $name = $("#ta-create-name").val();
    $uname = $("#ta-uname").val();
    $pass = $("#ta-new-pass").val();
    $pass_confirm = $("#ta-pass-check").val();
    $auth = $("#ta-auth").val();
    
    // make sure passwords confirm first
    $.ajax({ url: 'php/ta_register.php',
         data: {action: 'create_ta', name: $name, uname: $uname, pass: $pass, pass_confirm: $pass_confirm, auth: $auth},
         type: 'post',
         success: function(output) {
             if(output == true){
                 alert("Registration Successfull");
             } else {
                 alert("Registration Unsuccessfull");
             }
         }
    });
});

/**
    Responsible for initializing all of the variables that will be used in
    the future of this application
*/
$(document).ready(function(){
    // LAB INFO
    sessionStorage.setItem("lab-name", null);
    sessionStorage.setItem("lab-pin", null);
    // USER INFO
    sessionStorage.setItem("user-type", null);
    sessionStorage.setItem("user-name", null);
    sessionStorage.setItem("user-uname", null);
    sessionStorage.setItem("user-valid", false);
});

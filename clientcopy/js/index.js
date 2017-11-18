$("#student-btn").click(function(){
    $("#selection").hide();
    $("#student-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
    $("#forms").show();
});

$("#ta-btn").click(function(){
    $("#selection").hide();
    $("#ta-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
    $("#forms").show();
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
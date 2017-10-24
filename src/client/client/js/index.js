$("#student-btn").click(function(){
    $(".select").hide();
    $("#register").css({"visibility": "hidden", "display": "none"});
    $("#forms").css({"visibility": "visible", "display": "block"});
    $("#student-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
});

$("#ta-btn").click(function(){
    $(".select").hide();
    $("#register").css({"visibility": "hidden", "display": "none"});
    $("#forms").css({"visibility": "visible", "display": "block"});
    $("#ta-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
});

$("#cancel").click(function(){
    $(".select").show();
    $("#register").css({"visibility": "visible", "display": "inline"});
    $("#forms").css({"visibility": "hidden", "display": "none"});
    $("#ta-form").css({"visibility": "hidden", "display": "none"});
    $("#student-form").css({"visibility": "hidden", "display": "none"});
    $("#ta-register").css({"visibility": "hidden", "display": "none"});
    $("#cancel").css({"visibility": "hidden", "display": "none"});
});

$("#register").click(function(){
    $(".select").hide();
    $("#register").css({"visibility": "hidden", "display": "none"});
    $("#forms").css({"visibility": "visible", "display": "block"});
    $("#ta-form").css({"visibility": "hidden", "display": "none"});
    $("#student-form").css({"visibility": "hidden", "display": "none"});
    $("#ta-register").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});

});

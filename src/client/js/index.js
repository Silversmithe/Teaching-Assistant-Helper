$("#student-btn").click(function(){
    $(".select").hide();
    $("#forms").css({"visibility": "visible", "display": "block"});
    $("#student-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
});

$("#ta-btn").click(function(){
    $(".select").hide();
    $("#forms").css({"visibility": "visible", "display": "block"});
    $("#ta-form").css({"visibility": "visible", "display": "block"});
    $("#cancel").css({"visibility": "visible", "display": "block"});
});

$("#cancel").click(function(){
    $(".select").show();
    $("#forms").css({"visibility": "hidden", "display": "none"});
    $("#ta-form").css({"visibility": "hidden", "display": "none"});
    $("#student-form").css({"visibility": "hidden", "display": "none"});
    $("#cancel").css({"visibility": "hidden", "display": "none"});
});
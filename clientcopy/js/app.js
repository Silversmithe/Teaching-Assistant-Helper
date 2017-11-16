/*==== Question and Answer Object ====*/
class QAObject {   
    // questions and answers
    constructor(id, timestamp, name, question, answer){
        this.id = id;
        this.timestamp = timestamp;
        this.name = name;
        this.quesiton = question;
        this.answer = answer;
        this.answered = (this.answer != null);
    }
    
    setAnswer(answer){
        this.answer = answer;
        this.answered = (this.answer != null);
    }
    
    getID() { alert(this.id); }
}

/*==== Announcement Object ====*/
class AObject {
    // announcements
    constructor(id, announcement){
        this.id = id;
        this.announcement = announcement;
    }
}

/*==== CLIENT QA & A ARRAYS =====*/
var QAArray = [];
var AArray = [];

/*==== LOAD ON DOCUMENT READY ====*/
$(document).ready(function(){
    pullAndLoad();
});


function pullAndLoad(){
    
    /*==== AJAX =====*/
    // pull all QA information and put it in a database
    $.ajax({ url: 'pull_session_info.php',
         data: {action: 'pull_qa'},
         type: 'post',
         success: function(output) {
            var json = JSON.stringify(output);
            var qaarray = JSON.parse(output);
            
            for(var i=0; i<qaarray.length; i++){
                var qa = qaarray[i];
                QAArray.push(new QAObject(qa.id, qa.timestamp, qa.name, qa.question, qa.answer));
            }
             
            // Dynamically display Questions and Answers
            QAArray.forEach(function(item){
                var answered="";
                var $answer;
                if(!item.answered){
                    answered = "unanswered";
                    $answer = $("<p>", {class: "answer"}).text("");
                } else {
                    $answer = $("<p>", {class: "answer"}).text("TA: " + item.answer);
                }
                var $div = $("<div>", {id: item.id, class: "QA well well-sm " + answered});
                
                var $time = $("<i>").text(item.timestamp);
                var $question = $("<blockquote>").text(item.name + ": " + item.quesiton);
                $div.append($time, $question, $answer);

                $("#app-forum").append($div);
            });

         } // end SUCCESS
    });
    
    // pull all Announcement information and put it in the database
    $.ajax({ url: 'pull_session_info.php',
     data: {action: 'pull_a'},
     type: 'post',
     success: function(output) {
        var json = JSON.stringify(output);
        var aarray = JSON.parse(output);

        for(var i=0; i<aarray.length; i++){
            var announce = aarray[i];
            AArray.push(new AObject(announce.id, announce.announcement));
        }

        // Dynamically display Questions and Answers
        AArray.forEach(function(item){

            var $announce = $("<blockquote>").text(item.announcement);
            var $div = $("<div>", {id: item.id, class: "announcement well well-sm"}).append($announce);

            $("#app-announce").append($div);
        });

     } // end SUCCESS
    });
    
}

/* ==== FUNCTIONALITY === */
$(document).on('click', "#announce-btn", function(){
    var isHidden = ($("#announce").css("display") == "none");
    
    if(isHidden){
        // unhide announcements and hide questions
        $("#announce").css("display", "block");
        $("#qa").css("display", "none");
    } else {
        // unhide announcements and hide questions
        $("#announce").css("display", "none");
        $("#qa").css("display", "block");
    } 
});

/*===== LIVE EVENT DEFINITIONS =====*/
$(document).on('click', '.QA', function(){
    var qa = null;
    var itemID = parseInt($(this).attr("id"));

    QAArray.forEach(function(item){
        if(item.id == itemID){
            qa = item;
        } 
    });
    
    if(qa != null){   
        $("#qID").val(qa.id);
        $("#modalLabel").text("Answer question from: " + qa.name);
        $("#student-question").text(qa.quesiton);
        $("#squest").val(qa.quesiton);
        if(qa.answer != null){
            $("#ta-answer").val(qa.answer);
        }
        
        $("#myModal").modal("show");                
    }
});

$(document).on('click', '#response-submit', function(){
    var qID = parseInt($("#qID").val());
    var ans = $("#ta-answer").val();
    
    // pushing the question and answer
    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_qa_response', qaID: qID, answer: ans},
         type: 'post',
         success: function(output) {
             // close the modal
             closeModal();
         }
    });
    
    // reload all the js 
    $(".QA").remove();
    $(".announcement").remove();
    QAArray = [];
    AArray = [];
    pullAndLoad();
});

/* STATIC UI ELEMENTS */
function closeModal(){
    $("#qID").val("");
    $("#modalLabel").text("");
    $("#student-question").text("");
    $("#squest").val("");
    $("#ta-answer").val("");

    $("#myModal").modal("hide");
}

$(".modal-close").click(function(){
    closeModal();
});

$("#send-question").click(function(){
    $question =  $("#qa-bar").val();
    
    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_qa', question: $question},
         type: 'post',
         success: function(output) {}
    });
    
    // clear out message bar
    $("#qa-bar").val("");
                          
    // reload all the js 
    $(".QA").remove();
    $(".announcement").remove();
    QAArray = [];
    AArray = [];
    pullAndLoad();
});

$("#send-announcement").click(function(){
    $announcement =  $("#a-bar").val();
    
    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_a', announcement: $announcement},
         type: 'post',
         success: function(output) {}
    });
                              
    // clear out message bar
    $("#a-bar").val("");
    
    // reload all the js 
    $(".QA").remove();
    $(".announcement").remove();
    QAArray = [];
    AArray = [];
    pullAndLoad();
});


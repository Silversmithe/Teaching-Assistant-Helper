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

//    if(sessionStorage.getItem("user-valid") != true){
//        location.replace("../index.php");
//    }
    
    $utype = sessionStorage.getItem("user-type");
    $name = sessionStorage.getItem("user-name");
    $lab_name = sessionStorage.getItem("lab-name");
    $lab_pin = sessionStorage.getItem("lab-pin");
    
    // load navbar
    $lab_user_name = $lab_name + ": " + String($utype);
    $("#lab-user-name").text($lab_user_name);
    
    // load welcome
    $welcome = "Welcome, " + String($name);
    $("#welcome-title").text($welcome);
    
    if($utype == "ta"){
        // load pin
        $("#pin-info").text("PIN: " + String($lab_pin));
		// hide student input
		$("#student-input").css("display", "none"); 
    } else {
		// student page, so hide TA input
		$("#ta-input").css("display", "none");
	}
    
    pullAndLoad();
    window.setInterval(interrupt, 5000);
});

function interrupt(){
    pullAndLoad();
}


function pullAndLoad(){
    
	$pin = sessionStorage.getItem("lab-pin");
	if($pin == null) return;

    /*==== AJAX =====*/
    // pull all QA information and put it in a database
    $.ajax({ url: 'pull_session_info.php',
         data: {action: 'pull_qa', pin: $pin},
         type: 'post',
         success: function(output) {
			// KICK off if there is an INVALID pull
			if(output == false){ location.replace("../index.php"); }

            var json = JSON.stringify(output);
            var qaarray = JSON.parse(output);
            var oldLen = QAArray.length;

	    	// pull what you need
            for(var i=0; i<qaarray.length; i++){
                var qa = qaarray[i];
		
				if( i < oldLen ){
					// if the item exists in the array
					// just update all the values
					QAArray[i] = new QAObject(qa.id, qa.timestamp, qa.name, qa.question, qa.answer);
					if(QAArray[i].answered == true){
						$("#" + QAArray[i].id).removeClass("unanswered");
					}
				} else {
				    QAArray.push(new QAObject(qa.id, qa.timestamp, qa.name, qa.question, qa.answer));
				}
			}

			// rebuild all previous elements here
			for(var i=0; i<oldLen; i++){
				if(QAArray[i].answered == true){
					document.getElementById("ans-" + QAArray[i].id).innerHTML = "TA: " + QAArray[i].answer;
				}

				// check dismissal
				if(QAArray[i].answer == "#DISMISSED"){
					// change its color
					$("#" + QAArray[i].id).css("background-color", "#blue");
				} else {
					// default color
					$("#" + QAArray[i].id).css("background-color", "#f5f5f5");
				}
			}
	  
		        // Dynamically display Questions and Answers
			for(var i=oldLen; i<qaarray.length; i++){
				var item = QAArray[i];

				var answered="";
				var $answer;
				if(!item.answered){
					answered = "unanswered";
					$answer = $("<p>", {id: "ans-" + item.id, class: "answer"}).text("");
				} else {
					$answer = $("<p>", {id: "ans-" + item.id, class: "answer"}).text("TA: " + item.answer);
				}

				var $div = $("<div>", {id: item.id, class: "QA well well-sm " + answered});
		
				var $time = $("<i>").text(item.timestamp);
				var $question = $("<blockquote>", {class: "question"}).text(item.name + ": " + item.quesiton);

				$div.append($time, $question, $answer);
				$("#app-forum").append($div);
			}
		} // end SUCCESS
    });
    
    // pull all Announcement information and put it in the database
    $.ajax({ url: 'pull_session_info.php',
     data: {action: 'pull_a', pin: $pin},
     type: 'post',
     success: function(output) {
		if(output == false){ location.replace("../index.php"); }

        var json = JSON.stringify(output);
        var aarray = JSON.parse(output);
		var oldLen = AArray.length;

        for(var i=oldLen; i<aarray.length; i++){
            var announce = aarray[i];
            AArray.push(new AObject(announce.id, announce.announcement));
        }

        // Dynamically display Questions and Answers
        for(var i=oldLen; i<aarray.length; i++){
	    	var item = AArray[i];

            var $announce = $("<blockquote>").text(item.announcement);
            var $div = $("<div>", {id: item.id, class: "announcement well well-sm"}).append($announce);
            $("#app-announce").append($div);
        }

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

    var user = sessionStorage.getItem("user-type");

    var qa = null;
    var itemID = $(this).attr("id");
    
    QAArray.forEach(function(item){
        if(item.id == itemID){
            qa = item;
        } 
    });
    
    if(qa != null){   
        $("#qID").val(qa.id);
	// if this isnt your question, do not open anything
	if(user == "student"){
		// make sure only students that make questions can 
		// answer them
		var uname = sessionStorage.getItem("user-name");
		if(qa.name != uname){ return; }
	}

	// enable or disable the change of a response
	if(user == "ta"){
		$("#ta-answer").prop("disabled", false);
		$("#response-submit").show();
	} else {
		$("#ta-answer").prop("disabled",  true);
		$("#response-submit").hide();	
	}
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
    var qID = $("#qID").val();
    var ans = $("#ta-answer").val();
    
    // pushing the question and answer
    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_qa_response', qaID: qID, answer: ans},
         type: 'post',
         success: function(output) {
             // close the modal
             closeModal();
	     // load all of the js
	     pullAndLoad();
         }
    });
});

$(document).on('click', '#dismiss-qa', function(){
	var qID = $("#qID").val();
	var ans = "#DISMISSED";

    // pushing the question and answer
    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_qa_response', qaID: qID, answer: ans},
         type: 'post',
         success: function(output) {
             // close the modal
             closeModal();
			 // load all of the js
			 pullAndLoad();
         }
    });
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

$("#logout-btn").click(function(){
	$type = sessionStorage.getItem("user-type");
	$pin = sessionStorage.getItem("lab-pin");
    $.ajax({ url: 'logout.php',
         data: {action: 'logout', type: $type, pin: $pin},
         type: 'post',
         success: function(output) {
			// logout script
		    // LAB INFO
			sessionStorage.setItem("lab-name", null);
			sessionStorage.setItem("lab-pin", null);
			// USER INFO
			sessionStorage.setItem("user-type", null);
			sessionStorage.setItem("user-name", null);
			sessionStorage.setItem("user-uname", null);
			sessionStorage.setItem("user-valid", false);

			if($type== "ta"){
				location="../php/lab" + $pin + ".txt";
				return;
			}
			// change the location back to index
			location.replace("../index.php");
		 }
    });
});

$(".modal-close").click(function(){
    closeModal();
});

$("#send-question").click(function(){
	if(sessionStorage.getItem("user-type") == "ta") return;
	// since it is a student name & uname are the same
	$name = sessionStorage.getItem("user-name"); 
	$pin = sessionStorage.getItem("lab-pin");
	$question =  $("#qa-bar").val();

    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_qa', question: $question, name: $name, pin: $pin},
         type: 'post',
         success: function(output) {
		// clear out message bar
		$("#qa-bar").val("");
		// reload all the js
		pullAndLoad();	
	}
    });
});

$("#send-announcement").click(function(){
	if(sessionStorage.getItem("user-type") == "student") return;
    $announcement =  $("#a-bar").val();
	$pin = sessionStorage.getItem("lab-pin");
    
    $.ajax({ url: 'push_session_info.php',
         data: {action: 'push_a', announcement: $announcement, pin: $pin},
         type: 'post',
         success: function(output) {
		// clear out message bar
		$("#a-bar").val("");
		// reload all the js
		pullAndLoad();
	}
    });
});


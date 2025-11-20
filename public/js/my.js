




//-------- add comment to posts -----//
function add_comment(post_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var content=document.getElementById('content'+post_id).value;

    var dataString='content='+ content+ '&post_id='+ post_id;


    $.ajax(
    {
        type:"POST",
        url:"/user_panel/posts/add_comment",
        data:dataString,
        success: function () {
            $('#com'+post_id).load(' #com'+post_id);
            $('#com_count_'+post_id).load(' #com_count_'+post_id);
        }

    });


    return false;

}

//------- like & dislike posts ------//

function like_post(post_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='post_id='+ post_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/posts/like_post",
            data:dataString,
            success: function () {
                $('#like_'+post_id).load(' #like_'+post_id);
            }

        });


    return false;

}




//======== add answer to question ==========//

function add_answer(question_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var answer=document.getElementById('answer'+question_id).value;

    var dataString='answer='+ answer+ '&question_id='+ question_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/question_answer/create_answer",
            data:dataString,
            success: function () {
                $('#answers'+question_id).load(' #answers'+question_id);
                $('#answers_count'+question_id).load(' #answers_count'+question_id);
            }

        });


    return false;

}


//========== Question up vote down vote =======//

function question_up_vote(question_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='question_id='+ question_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/question_answer/question_up_vote",
            data:dataString,
            success: function () {
                $('#vote'+question_id).load(' #vote'+question_id);
            }

        });


    return false;

}

function question_down_vote(question_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='question_id='+ question_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/question_answer/question_down_vote",
            data:dataString,
            success: function () {
                 $('#vote'+question_id).load(' #vote'+question_id);
            }

        });


    return false;

}


//========== Answer up vote down vote =======//

function answer_up_vote(answer_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='answer_id='+ answer_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/question_answer/answer_up_vote",
            data:dataString,
            success: function () {
                $('#answer_vote'+answer_id).load(' #answer_vote'+answer_id);
            }

        });


    return false;

}

function answer_down_vote(answer_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='answer_id='+ answer_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/question_answer/answer_down_vote",
            data:dataString,
            success: function () {
                $('#answer_vote'+answer_id).load(' #answer_vote'+answer_id);
            }

        });


    return false;

}


//========== shared file up vote down vote =======//

function shared_file_up_vote(shared_file_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='shared_file_id='+ shared_file_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/library/shared_file_up_vote",
            data:dataString,
            success: function () {
                $('#shared_file_vote'+shared_file_id).load(' #shared_file_vote'+shared_file_id);
            }

        });


    return false;

}

function shared_file_down_vote(shared_file_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataString='shared_file_id='+ shared_file_id;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/library/shared_file_down_vote",
            data:dataString,
            success: function () {
                $('#shared_file_vote'+shared_file_id).load(' #shared_file_vote'+shared_file_id);
            }

        });


    return false;

}

//-----------quiz


function add_quiz_question(course_id,quiz_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var question=document.getElementById('question').value;
    var answer1=document.getElementById('answer1').value;
    var answer2=document.getElementById('answer2').value;
    var answer3=document.getElementById('answer3').value;
    var answer4=document.getElementById('answer4').value;
    var true_answer;

    if (document.getElementById('true_answer1').checked) {
        true_answer = document.getElementById('true_answer1').value;
    }
    else if (document.getElementById('true_answer2').checked) {
         true_answer = document.getElementById('true_answer2').value;
    }
    else if (document.getElementById('true_answer3').checked) {
         true_answer = document.getElementById('true_answer3').value;
    }
    else if (document.getElementById('true_answer4').checked) {
         true_answer = document.getElementById('true_answer4').value;
    }

    var dataString='question='+ question+ '&answer1='+ answer1+ '&answer2='+ answer2+ '&answer3='+ answer3+ '&answer4='+ answer4+ '&true_answer='+ true_answer;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/course/"+course_id+"/course_management/make_quiz/"+quiz_id+"/add_quiz_question",
            data:dataString,
            success: function () {

                $('#quiz_questions').load(' #quiz_questions');
                $('#add_new_question').load(' #add_new_question');
            }

        });
    return false;

}


function update_quiz_question(course_id,quiz_question_id){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var question=document.getElementById('question_'+quiz_question_id).value;
    var answer1=document.getElementById('answer1_'+quiz_question_id).value;
    var answer2=document.getElementById('answer2_'+quiz_question_id).value;
    var answer3=document.getElementById('answer3_'+quiz_question_id).value;
    var answer4=document.getElementById('answer4_'+quiz_question_id).value;
    var true_answer;

    if (document.getElementById('true_answer1_'+quiz_question_id).checked) {
        true_answer = document.getElementById('true_answer1_'+quiz_question_id).value;
    }
    else if (document.getElementById('true_answer2_'+quiz_question_id).checked) {
        true_answer = document.getElementById('true_answer2_'+quiz_question_id).value;
    }
    else if (document.getElementById('true_answer3_'+quiz_question_id).checked) {
        true_answer = document.getElementById('true_answer3_'+quiz_question_id).value;
    }
    else if (document.getElementById('true_answer4_'+quiz_question_id).checked) {
        true_answer = document.getElementById('true_answer4_'+quiz_question_id).value;
    }

    var dataString='question='+ question+ '&answer1='+ answer1+ '&answer2='+ answer2+ '&answer3='+ answer3+ '&answer4='+ answer4+ '&true_answer='+ true_answer;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/course/"+course_id+"/course_management/make_quiz/"+quiz_question_id+"/update_quiz_question",
            data:dataString,
            success: function () {

                $('#quiz_question_'+quiz_question_id).load(' #quiz_question_'+quiz_question_id);
            }

        });
    return false;

}


function quiz_update(course_id,quiz_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var title=document.getElementById('title').value;
    var description=document.getElementById('description').value;
    var time_limitation=document.getElementById('time_limitation').value;

    if (document.getElementById('time_is_limited').checked) {
        var time_is_limited = document.getElementById('time_is_limited').value;
        var dataString='title='+ title+ '&description='+ description+ '&time_limitation='+ time_limitation+ '&time_is_limited='+ time_is_limited;
    }
    else
    {
        var dataString='title='+ title+ '&description='+ description+ '&time_limitation='+ time_limitation;
    }



    $.ajax(
        {
            type:"POST",
            url:"/user_panel/course/"+course_id+"/course_management/make_quiz/"+quiz_id+"/update_quiz",
            data:dataString,
            success: function () {

                $('#quiz_info').load(' #quiz_info',function () {
                    $("#time_is_limited").change(function () {
                        if ($(this).is(":checked")) {
                            $("#time_limited").show();
                        } else {
                            $("#time_limited").hide();
                        }
                    });

                });
            }

        });
    return false;


}


function quiz_question_delete(course_id,quiz_question_id){




    $.ajax(
        {
            type:"GET",
            url:"/user_panel/course/"+course_id+"/course_management/make_quiz/"+quiz_question_id+"/delete_quiz_question",
            success: function () {

                $('#quiz_questions').load(' #quiz_questions');
            }

        });
    return false;

}



//----course
function course_register(course_id){


    $.ajax(
        {
            type:"GET",
            url:"/user_panel/course/"+course_id+"/course_register",
            success: function () {

                $('#register').load(' #register');
                $('#send_review').load(' #send_review');
            }

        });
    return false;

}

function leave_course(course_id){


    $.ajax(
        {
            type:"GET",
            url:"/user_panel/course/"+course_id+"/leave_course",
            success: function () {

                $('#register').load(' #register');
                $('#send_review').load(' #send_review');
            }

        });
    return false;

}

//-------course question and answer

function add_course_question(course_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var question=document.getElementById('question').value;

    var dataString='question='+ question;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/course/"+course_id+"/create_course_question",
            data:dataString,
            success: function () {
                $('#ask_question').load(' #ask_question');
                $('#course_questions').load(' #course_questions');
            }

        });


    return false;

}

function add_course_answer(course_question_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var answer=document.getElementById('answer'+course_question_id).value;

    var dataString='answer='+ answer;


    $.ajax(
        {
            type:"POST",
            url:"/user_panel/course/"+course_question_id+"/create_course_answer",
            data:dataString,
            success: function () {
                $('#course_answers'+course_question_id).load(' #course_answers'+course_question_id);
                $('#course_answers_count'+course_question_id).load(' #course_answers_count'+course_question_id);
            }

        });


    return false;

}


//--follow--------
function follow(user_id){


    $.ajax(
        {
            type:"GET",
            url:"/user_panel/"+user_id+"/follow_user",
            success: function () {

                $('#follow').load(' #follow');
            }

        });
    return false;

}

function un_follow(user_id){


    $.ajax(
        {
            type:"GET",
            url:"/user_panel/"+user_id+"/un_follow_user",
            success: function () {

                $('#follow').load(' #follow');
            }

        });
    return false;

}



$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

//profile------------
function delete_profile_image(){
    $("#show_pro_img").attr('src','/storage/profile_images/default_profile.jpg');
    $("#del_pro_img").hide();
    $("#delete_profile_image").val('1');
}

$("#profile_image").change(function() {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        if(this.files[0].type.match('image.*')) {
            reader.onload = function(e) {

                $("#show_pro_img").attr('src', e.target.result);
                $("#del_pro_img").hide();

            }
        }


        reader.readAsDataURL(this.files[0]);
    }
});



//posts------------

function delete_old_post_file(){
    $("#show_post_file").addClass("selected").html(' ');
    $("#delete_old_post_file").hide();
    $("#delete_file").val('1');
}

$("#post_file").change(function() {

    $("#show_post_file").addClass("selected").html('');
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        if(this.files[0].type.match('image.*')) {
            reader.onload = function(e) {

                $("#show_post_file").addClass("selected").html('<img id="post_image" src="" alt="postfile" width="200px" class="img-fluid">');
                $('#post_image').attr('src', e.target.result);
            }
        }
        if(this.files[0].type.match('video.*')) {
            reader.onload = function(e) {

                $("#show_post_file").addClass("selected").html(
                    '<video  width="200px" class="img-fluid" controls>\n' +
                    '  <source id="post_video" src="" type="video/mp4">\n' +
                    '</video>'
                );

                $('#post_video').attr('src', e.target.result);
            }
        }

        reader.readAsDataURL(this.files[0]);
    }
    $("#delete_old_post_file").hide();
});



//course----------------


$("#course_image").change(function() {

    $("#show_course_image").addClass("selected").html('');
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        if(this.files[0].type.match('image.*')) {
            reader.onload = function(e) {

                $("#show_course_image").addClass("selected").html('<img id="course_img" class="img-fluid rounded" src="" alt="course_img"  width="250px">');
                $('#course_img').attr('src', e.target.result);
            }
        }


        reader.readAsDataURL(this.files[0]);
    }
});


//tutorial video------------
$("#tutorial_video").change(function() {

    $("#show_tutorial_video").addClass("selected").html('');
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        if(this.files[0].type.match('video.*')) {
            reader.onload = function(e) {

                $("#show_tutorial_video").addClass("selected").html(
                    '<video  width="540px" class="img-fluid" controls>\n' +
                    '  <source id="tut_vid" src="" type="video/mp4">\n' +
                    '</video>'
                );
                $('#tut_vid').attr('src', e.target.result);
            }
        }


        reader.readAsDataURL(this.files[0]);
    }
});


///quiz

$("#time_is_limited").change(function () {
    if ($(this).is(":checked")) {
        $("#time_limited").show();
    } else {
        $("#time_limited").hide();
    }
});

function quiz_question_edit(quiz_question_id) {

    $("#quiz_question_show_"+quiz_question_id).hide();

    $("#quiz_question_edit_"+quiz_question_id).show();
}

function quiz_information_edit() {

    $("#quiz_information_show").hide();

    $("#quiz_information_edit").show();
}



///search tag=---------------

$(document).ready(function () {
    $("#search_tag").keyup(function () {

        $("#live_search_tag").show();
        var search_tag = $(this).val();

        $.ajax({

            type:'GET',
            url:'/user_panel/tags_search/live_search_tag',
            data:'search_tag='+search_tag,
            success:function (data) {
                $("#live_search_tag").html(data);
            }
            ,

        });

    });

});


///search user---------------

$(document).ready(function () {
    $("#search_user").keyup(function () {

        $("#live_search_user").show();
        var search_user = $(this).val();

        $.ajax({

            type:'GET',
            url:'/user_panel/users_search/live_search_user',
            data:'search_user='+search_user,
            success:function (data) {
                $("#live_search_user").html(data);
            }
            ,

        });

    });

});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@public_start')->name('start_page');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//--multi-language

Route::get('locale/{locale}','UserSettingController@change_language');


//=== profile === user ===

Route::get('/user_panel/profile/user_profile','UserController@user_profile')->name('profile.user_profile');
Route::get('/user_panel/profile/edit_profile','UserController@edit_profile')->name('profile.edit_profile');

Route::put('/user_panel/profile/update_profile','UserController@update')->name('profile.update_profile');


Route::get('/user_panel/{user_id}/show_user','UserController@show_user')->name('profile.show_user');

Route::get('/user_panel/{user_id}/follow_user','UserController@follow')->name('profile.follow_user');
Route::get('/user_panel/{user_id}/un_follow_user','UserController@un_follow')->name('profile.un_follow_user');

Route::post('/user_panel/profile/update_password','UserController@reset_password')->name('profile.update_password');

Route::get('/user_panel/profile/notifications', function () {
    return view('profile.notifications');
})->name('profile.notifications');

//===== posts ========

Route::get('/user_panel/posts/my_posts','PostController@my_posts')->name('posts.my_posts');

Route::get('/user_panel/posts/following_posts','PostController@following_posts')->name('posts.following_posts');

Route::get('/user_panel/posts/add_new_post','PostController@add_new_post')->name('posts.add_new_post');

Route::post('/user_panel/posts/create_new_post','PostController@create')->name('posts.create_new_post');

Route::get('/user_panel/posts/{id}/edit_post','PostController@edit_post')->name('posts.edit_post');

Route::put('/user_panel/posts/{id}/update_post','PostController@update')->name('posts.update_post');

Route::get('/user_panel/posts/{id}/delete_post','PostController@delete')->name('posts.delete_post');

Route::post('/user_panel/posts/add_comment','CommentController@add_comment')->name('posts.add_comment');

Route::post('/user_panel/posts/like_post','PostLikeController@like_post')->name('posts.like_post');



//===== library ========

Route::get('/user_panel/library/my_shared_files','SharedFileController@my_shared_files')->name('library.my_shared_files');

Route::get('/user_panel/library/following_shared_files','SharedFileController@following_shared_files')->name('library.following_shared_files');

Route::get('/user_panel/library/top_shared_files','SharedFileController@top_shared_files')->name('library.top_shared_files');

Route::get('/user_panel/library/share_file','SharedFileController@share_file')->name('library.share_file');

Route::post('/user_panel/library/create_shared_file','SharedFileController@create')->name('library.create_shared_file');

Route::get('/user_panel/library/{id}/edit_shared_file','SharedFileController@edit_shared_file')->name('library.edit_shared_file');

Route::put('/user_panel/library/{id}/update_shared_file','SharedFileController@update')->name('library.update_shared_file');

Route::get('/user_panel/library/{id}/delete_shared_file','SharedFileController@delete')->name('library.delete_shared_file');

Route::get('/user_panel/library/shared_file_download/{id}','SharedFileController@download')->name('library.shared_file_download');

Route::post('/user_panel/library/shared_file_up_vote','SharedFileVoteController@shared_file_up_vote')->name('library.shared_file_up_vote');
Route::post('/user_panel/library/shared_file_down_vote','SharedFileVoteController@shared_file_down_vote')->name('library.shared_file_down_vote');



//======== question answer =======

Route::get('/user_panel/question_answer/recent_questions','QuestionController@recent_questions')->name('question_answer.recent_questions');

Route::get('/user_panel/question_answer/top_questions','QuestionController@top_questions')->name('question_answer.top_questions');

Route::get('/user_panel/question_answer/following_questions','QuestionController@following_questions')->name('question_answer.following_questions');

Route::get('/user_panel/question_answer/my_questions','QuestionController@my_questions')->name('question_answer.my_questions');

Route::get('/user_panel/question_answer/ask_question','QuestionController@ask_question')->name('question_answer.ask_question');

Route::get('/user_panel/question_answer/{id}/edit_question','QuestionController@edit_question')->name('question_answer.edit_question');

Route::post('/user_panel/question_answer/create_new_question','QuestionController@create_question')->name('question_answer.create_new_question');

Route::post('/user_panel/question_answer/{id}/update_question','QuestionController@update_question')->name('question_answer.update_question');

Route::get('/user_panel/question_answer/{id}/delete_question','QuestionController@delete_question')->name('question_answer.delete_question');

Route::post('/user_panel/question_answer/create_answer','AnswerController@create_answer')->name('question_answer.create_answer');

Route::post('/user_panel/question_answer/question_up_vote','QuestionVoteController@question_up_vote')->name('question_answer.question_up_vote');
Route::post('/user_panel/question_answer/question_down_vote','QuestionVoteController@question_down_vote')->name('question_answer.question_down_vote');

Route::post('/user_panel/question_answer/answer_up_vote','AnswerVoteController@answer_up_vote')->name('question_answer.answer_up_vote');
Route::post('/user_panel/question_answer/answer_down_vote','AnswerVoteController@answer_down_vote')->name('question_answer.answer_down_vote');



//========= learning ==========

Route::get('/user_panel/learning/top_courses','CourseController@top_courses')->name('learning.top_courses');

Route::get('/user_panel/learning/my_courses_as_student','CourseController@my_courses_as_student')->name('learning.my_courses_as_student');


//=========== teaching


Route::get('/user_panel/teaching/create_new_course','CourseController@create_new_course')->name('teaching.create_new_course');

Route::get('/user_panel/teaching/my_courses_as_teacher','CourseController@my_courses_as_teacher')->name('teaching.my_courses_as_teacher');

Route::post('/user_panel/teaching/create_course','CourseController@create')->name('teaching.create_course');








//-------search-----//

Route::get('/user_panel/search','SearchController@search_page')->name('search.search');

Route::get('/user_panel/posts_search','SearchController@posts_search')->name('search.posts_search');

Route::get('/user_panel/courses_search','SearchController@courses_search')->name('search.courses_search');

Route::get('/user_panel/library_search','SearchController@library_search')->name('search.library_search');

Route::get('/user_panel/qa_search','SearchController@qa_search')->name('search.qa_search');

Route::get('/user_panel/users_search','SearchController@users_search')->name('search.users_search');

Route::get('/user_panel/tags_search','SearchController@tags_search')->name('search.tags_search');

Route::get('/user_panel/all_search','SearchController@all_search')->name('search.all_search');


Route::get('/user_panel/users_search/search_user','SearchController@search_user')->name('search.search_user');


Route::get('/user_panel/posts_search/search_post','PostController@search')->name('search.search_post');
Route::get('/user_panel/courses_search/search_course','CourseController@search')->name('search.search_course');
Route::get('/user_panel/courses_search/search_shared_file','SharedFileController@search')->name('search.search_shared_file');
Route::get('/user_panel/courses_search/search_question','QuestionController@search')->name('search.search_question');
Route::get('/user_panel/tags_search/search_tag','TagController@search')->name('search.search_tag');


Route::get('/user_panel/users_search/search_user','UserController@search')->name('search.search_user');



Route::get('/user_panel/users_search/live_search_user','SearchController@live_search_user')->name('search.live_search_user');

Route::get('/user_panel/tags_search/live_search_tag','SearchController@live_search_tag')->name('search.live_search_tag');




//-----------  course -------//

Route::get('/user_panel/course/{id}/course_register','CourseController@course_register')->name('course.course_register');

Route::get('/user_panel/course/{id}/leave_course','CourseController@leave_course')->name('course.leave_course');

Route::get('/user_panel/course/{id}/about_the_course','CourseController@about_the_course')->name('course.about_the_course');

Route::get('/user_panel/course/{id}/course_content','CourseController@course_content')->name('course.course_content');

Route::get('/user_panel/course/{id}/resources','CourseController@resources')->name('course.resources');

Route::get('/user_panel/course/{id}/qa','CourseController@qa')->name('course.qa');

Route::get('/user_panel/course/{id}/course_management','CourseController@course_management')->name('course.course_management');

Route::get('/user_panel/course/{course_id}/course_content/{edu_session_id}/show_tutorial_video/{tutorial_video_id}','CourseController@show_tutorial_video')->name('course.show_tutorial_video');
Route::get('/user_panel/course/{course_id}/course_content/{edu_session_id}/show_quiz/{quiz_id}','CourseController@show_quiz')->name('course.show_quiz');
Route::get('/user_panel/course/{course_id}/course_content/show_lesson/{lesson_id}','CourseController@show_lesson')->name('course.show_lesson');

//download resource
Route::get('/user_panel/course/{resource_id}/download_resource','ResourceController@download')
    ->name('course.download_resource');

//course question and answer
Route::post('/user_panel/course/{course_id}/create_course_question','CourseQuestionController@create')->name('course.create_course_question');
Route::post('/user_panel/course/{course_question_id}/create_course_answer','CourseAnswerController@create')->name('course.create_course_answer');

//--------- course management ---------//
Route::get('/user_panel/course/{id}/course_management/edit_course_info','CourseManagementController@edit_course_info')
    ->name('course.edit_course_info');

Route::get('/user_panel/course/{id}/course_management/manage_course_content','CourseManagementController@manage_course_content')
    ->name('course.manage_course_content');

Route::get('/user_panel/course/{id}/course_management/upload_edit_resources','CourseManagementController@upload_edit_resources')
    ->name('course.upload_edit_resources');

Route::get('/user_panel/course/{course_id}/course_management/upload_resources','CourseManagementController@upload_resources')
    ->name('course.upload_resources');
Route::post('/user_panel/course/{course_id}/course_management/create_resources','ResourceController@create')
    ->name('course.create_resources');

Route::get('/user_panel/course/{course_id}/course_management/{resource_id}/edit_resources','CourseManagementController@edit_resources')
    ->name('course.edit_resources');
Route::post('/user_panel/course/{course_id}/course_management/{resource_id}/update_resources','ResourceController@update')
    ->name('course.update_resources');

Route::get('/user_panel/course/{course_id}/course_management/{resource_id}/delete_resources','ResourceController@delete')
    ->name('course.delete_resources');


Route::get('/user_panel/course/{id}/course_management/manage_students','CourseManagementController@manage_students')
    ->name('course.manage_students');

Route::put('/user_panel/course/{id}/course_management/update_course_info','CourseController@update')
    ->name('course.update_course_info');

//lesson

Route::get('/user_panel/course/{id}/course_management/create_new_lesson','CourseManagementController@create_new_lesson')
    ->name('course.create_new_lesson');

Route::post('/user_panel/course/{id}/course_management/create_new_lesson/create_lesson','LessonController@create')->name('course.create_lesson');

Route::get('/user_panel/course/{course_id}/course_management/{lesson_id}/edit_lesson','CourseManagementController@edit_lesson')
    ->name('course.edit_lesson');

Route::put('/user_panel/course/{course_id}/course_management/{lesson_id}/update_lesson','LessonController@update')
    ->name('course.update_lesson');

Route::get('/user_panel/course/{course_id}/course_management/{lesson_id}/delete_lesson','LessonController@delete')
    ->name('course.delete_lesson');

//tutorial-video

Route::get('/user_panel/course/{course_id}/course_management/{lesson_id}/upload_tutorial_video','CourseManagementController@upload_tutorial_video')
    ->name('course.upload_tutorial_video');

Route::post('/user_panel/course/{course_id}/course_management/{lesson_id}/create_tutorial_video','TutorialVideoController@create')
    ->name('course.create_tutorial_video');

Route::get('/user_panel/course/{course_id}/course_management/{tutorial_video_id}/edit_tutorial_video','CourseManagementController@edit_tutorial_video')
    ->name('course.edit_tutorial_video');

Route::put('/user_panel/course/{course_id}/course_management/{tutorial_video_id}/update_tutorial_video','TutorialVideoController@update')
    ->name('course.update_tutorial_video');

Route::get('/user_panel/course/{course_id}/course_management/{tutorial_video_id}/delete_tutorial_video','TutorialVideoController@delete')
    ->name('course.delete_tutorial_video');


//quiz
Route::get('/user_panel/course/{course_id}/course_management/{lesson_id}/create_new_quiz','CourseManagementController@create_new_quiz')
    ->name('course.create_new_quiz');
Route::post('/user_panel/course/{course_id}/course_management/{lesson_id}/create_quiz','QuizController@create')
    ->name('course.create_quiz');

Route::get('/user_panel/course/{course_id}/course_management/make_quiz/{quiz_id}','CourseManagementController@make_quiz')
    ->name('course.make_quiz');

Route::post('/user_panel/course/{course_id}/course_management/make_quiz/{quiz_id}/add_quiz_question','QuizQuestionController@create')
    ->name('course.add_quiz_question');

Route::post('/user_panel/course/{course_id}/course_management/make_quiz/{quiz_question_id}/update_quiz_question','QuizQuestionController@update')
    ->name('course.update_quiz_question');

Route::post('/user_panel/course/{course_id}/course_management/make_quiz/{quiz_id}/update_quiz','QuizController@update')
    ->name('course.update_quiz');

Route::get('/user_panel/course/{course_id}/course_management/{quiz_id}/delete_quiz','QuizController@delete')
    ->name('course.delete_quiz');

Route::get('/user_panel/course/{course_id}/course_management/make_quiz/{quiz_question_id}/delete_quiz_question','QuizQuestionController@delete')
    ->name('course.delete_quiz_question');


Route::get('/user_panel/course/{course_id}/take_quiz/{quiz_id}','QuizAnswerController@take_quiz')
    ->name('course.take_quiz');

Route::post('/user_panel/course/{course_id}/quiz/{quiz_id}','QuizAnswerController@quiz')
    ->name('course.quiz');

Route::post('/user_panel/course/{course_id}/save_per_minute/{quiz_id}','QuizAnswerController@save_per_minute')
    ->name('course.save_per_minute');


Route::get('/user_panel/course/{course_id}/quiz_results/{quiz_id}','QuizController@quiz_results')
    ->name('course.quiz_results');

//------course review
Route::post('/user_panel/course/{course_id}/send_review','CourseReviewController@create')->name('course.send_review');

//-------tags

Route::get('/user_panel/{tag_id}/show_tag','TagController@show_tag')->name('tag.show_tag');

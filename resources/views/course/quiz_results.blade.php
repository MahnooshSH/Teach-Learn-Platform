@extends('course.course_content')


@section('show_course_content')

    <table class="table table-bordered table-responsive">
        <thead class="text-center">
        <tr>
            <th scope="col" width="250px">{{__('text.Student')}}</th>
            <th scope="col">{{__('text.Quiz score')}}</th>
            <th scope="col">{{__('text.Correct answers')}}</th>
            <th scope="col">{{__('text.Incorrect answers')}}</th>
            <th scope="col">{{__('text.Unanswered')}}</th>
            <th scope="col" width="200px">{{__('text.Answer sheet')}}</th>
        </tr>
        </thead>
        <tbody>


        @foreach($quiz->quiz_answers()->orderBy('result','desc')->get() as $quiz_answer)

            <tr>
                <td>

                    <a href="{{route('profile.show_user',['user_id'=>$quiz_answer->student->id])}}">
                        <div class="media">
                            <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$quiz_answer->student->profile_image)}}"
                                 width="40px" height="40px" alt="student_profile">
                            <div class="media-body ml-3">
                                <div class="font-weight-bold">
                                    {{$quiz_answer->student->username}}
                                </div>
                                <div class="text-muted">
                                    {{$quiz_answer->student->first_name}} {{$quiz_answer->student->last_name}}
                                </div>
                            </div>
                        </div>
                    </a>

                </td>
                <td class="text-center">{{$quiz_answer->result}}</td>
                <td class="text-center">{{$quiz_answer->true_count}}</td>
                <td class="text-center">{{$quiz_answer->wrong_count}}</td>
                <td class="text-center">{{$quiz_answer->unanswered_count}}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#answer_sheet{{$quiz_answer->id}}">
                        {{__('text.Show answer sheet')}}
                    </button>


                    <div class="modal fade" id="answer_sheet{{$quiz_answer->id}}" tabindex="-1" role="dialog" aria-labelledby="answer_sheet{{$quiz_answer->id}}Title" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <div class="modal-title" id="answer_sheet{{$quiz_answer->id}}Title">

                                        <div class="ml-3 h5">
                                            {{__('text.Answer sheet')}}
                                        </div>

                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                   <div class="container">

                                       <div class="card">

                                           <div class="card-body">

                                               <div class="row">
                                                   <div class="col-sm-auto">
                                                       <div class="media ml-3">
                                                           <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$quiz_answer->student->profile_image)}}"
                                                                width="40px" height="40px" alt="student_profile">
                                                           <div class="media-body ml-3">
                                                               <div class="font-weight-bold">
                                                                   {{$quiz_answer->student->username}}
                                                               </div>
                                                               <div class="text-muted">
                                                                   {{$quiz_answer->student->first_name}} {{$quiz_answer->student->last_name}}
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                       <div>
                                                           <span class="text-muted">{{__('text.Quiz score')}} :</span>
                                                           {{$quiz_answer->result}}
                                                           <span class="text-muted">/100</span>
                                                       </div>

                                                       <div>
                                                           <span class="text-muted">{{__('text.Correct answers')}} :</span>
                                                           {{$quiz_answer->true_count}}
                                                       </div>

                                                       <div>
                                                           <span class="text-muted">{{__('text.Incorrect answers')}} :</span>
                                                           {{$quiz_answer->wrong_count}}
                                                       </div>

                                                       <div>
                                                           <span class="text-muted">{{__('text.Unanswered')}} :</span>
                                                           {{$quiz_answer->unanswered_count}}
                                                       </div>
                                                   </div>
                                               </div>


                                           </div>

                                       </div>

                                       @php
                                           $answer=$quiz_answer->answer;
                                           $answer_array=unserialize($answer);
                                       @endphp


                                       @foreach($quiz->quiz_questions as $quiz_question)

                                           <div class="mb-2 mt-2">
                                               {{$quiz_question->question}}
                                           </div>
                                           @php
                                               $student_answer=0;
                                           @endphp
                                           @isset($answer_array[$quiz_question->id])
                                               @php
                                                   $student_answer=$answer_array[$quiz_question->id];
                                               @endphp
                                           @endisset
                                           <div>
                                               @if($quiz_question->true_answer==1 and $student_answer==1)
                                                   <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                                               @elseif($student_answer==1)
                                                   <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                                               @else
                                                   <i class="far fa-circle icon_size_xs"></i>
                                               @endif
                                               {{$quiz_question->answer1}}
                                           </div>
                                           <div>
                                               @if($quiz_question->true_answer==2 and $student_answer==2)
                                                   <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                                               @elseif($student_answer==2)
                                                   <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                                               @else
                                                   <i class="far fa-circle icon_size_xs"></i>
                                               @endif
                                               {{$quiz_question->answer2}}
                                           </div>
                                           <div>
                                               @if($quiz_question->true_answer==3 and $student_answer==3)
                                                   <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                                               @elseif($student_answer==3)
                                                   <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                                               @else
                                                   <i class="far fa-circle icon_size_xs"></i>
                                               @endif
                                               {{$quiz_question->answer3}}
                                           </div>
                                           <div>
                                               @if($quiz_question->true_answer==4 and $student_answer==4)
                                                   <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                                               @elseif($student_answer==4)
                                                   <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                                               @else
                                                   <i class="far fa-circle icon_size_xs"></i>
                                               @endif
                                               {{$quiz_question->answer4}}
                                           </div>

                                           <hr>
                                       @endforeach

                                   </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </td>
            </tr>

        @endforeach


        </tbody>
    </table>



@endsection

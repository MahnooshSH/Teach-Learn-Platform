@extends('question_answer.question_answer')
@section('active_following_questions')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="following_questions">

            @foreach($questions as $question)

                @include('question_answer.show_question')

            @endforeach

        </div>
    </div>
@endsection

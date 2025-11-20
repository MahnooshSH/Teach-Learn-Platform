@extends('question_answer.question_answer')
@section('active_top_questions')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="top_questions">

            @foreach($questions as $question)

                @include('question_answer.show_question')

            @endforeach

        </div>
    </div>
@endsection

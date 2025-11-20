@extends('question_answer.question_answer')
@section('active_recent_questions')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="recent_questions">





            @foreach($questions as $question)

                @include('question_answer.show_question')

            @endforeach





        </div>
    </div>
@endsection

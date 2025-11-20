@extends('library.library')
@section('active_top_shared_files')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="top_shared_files">


            @foreach($shared_files as $shared_file)


                @include('library.show_shared_file')


            @endforeach





        </div>
    </div>
@endsection

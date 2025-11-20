@extends('profile.profile')
@section('active_edit_profile')
    active
@endsection
@section('tab_content')

        <div class="tab-content">
                <div class="tab-pane active" id="edit_profile">
                    <div class="row">
                        <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{__('text.Edit User info')}}
                        </div>
                        <div class="card-body">
                            <div class="container">
                            <form method="post" action="{{route('profile.update_profile')}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="username">{{__('text.username')}}</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" name="username" placeholder="{{__('text.username')}}" value="{{Auth::user()->username}}">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">{{__('text.first name')}}</label>
                                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" name="first_name" placeholder="{{__('text.first name')}}" value="{{Auth::user()->first_name}}">
                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">{{__('text.last name')}}</label>
                                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" name="last_name" placeholder="{{__('text.last name')}}" value="{{Auth::user()->last_name}}">
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label for="profile_image">{{__('text.profile image')}}</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{ $errors->has('profile_image') ? ' is-invalid' : '' }}" id="profile_image" name="profile_image">
                                    <label class="custom-file-label" for="profile_image">
                                        {{__('text.Choose profile image')}}
                                    </label>
                                    @if ($errors->has('profile_image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                    <div id="show_profile_image">
                                        <div class="d-flex justify-content-around text-justify">
                                            <img id="show_pro_img" class="rounded-circle mt-3" src="{{asset('storage/profile_images/'.Auth::user()->profile_image)}}" width="100px" height="100px" alt="profile">
                                        </div>
                                        @if(Auth::user()->profile_image !='default_profile.jpg')
                                        <div class="d-flex justify-content-around text-justify">
                                            <a id="del_pro_img" class="btn btn-outline-secondary btn-sm mt-2" onclick="return delete_profile_image()">{{__('text.delete profile image')}}</a>
                                        </div>
                                            @endif
                                    </div>

                                </div>
                                <input type="hidden" id="delete_profile_image" name="delete_profile_image" value="0">

                                <div class="form-group">
                                    <label for="bio">{{__('text.Bio')}}</label>
                                    <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" id="bio" name="bio" placeholder="{{__('text.Bio')}}" rows="3" >{{Auth::user()->bio}}</textarea>
                                    @if ($errors->has('bio'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">{{__('text.Save')}}</button>
                            </form>
                        </div>
                        </div>
                    </div>
                        </div>
                        <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            {{__('text.Edit Password')}}
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="post" action="{{route('profile.update_password')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="old_password">{{__('text.old password')}}</label>
                                        <input type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" id="old_password" name="old_password" placeholder="{{__('text.old password')}}">
                                        @if ($errors->has('old_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{__('text.new password')}}</label>
                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="{{__('text.new password')}}">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">{{__('text.confirm password')}}</label>
                                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="{{__('text.confirm password')}}">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('text.Save')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                        </div>

                    </div>
                </div>
        </div>
@endsection

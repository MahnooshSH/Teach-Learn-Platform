<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }


    public function update(Request $request)
    {
        $id=Auth::user()->id;
        $request->validate([
            'username'=>'required|string|alpha_dash|max:30|unique:users,username,'.$id.'',
            'first_name'=>'required|string|alpha|max:50',
            'last_name'=>'required|string|alpha|max:50',
            'profile_image'=>'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'bio'=>'nullable|string|max:500',


        ]);
        $user=Auth::user();

        $user->update($request->only('username','first_name','last_name','bio'));
        if ($request->hasFile('profile_image')) {
            $old_image=$user->profile_image;

            $filename=$request->file('profile_image')->hashName();
            $path=$request->file('profile_image')->storeAs('profile_images',$filename,'public');

            Image::make(storage_path('app/public/'.$path))
                ->resize(400,400)
                ->save(storage_path('app/public/'.$path));

            $user->update(['profile_image'=>$filename]);

            if(is_file((storage_path('app/public/profile_images/'.$old_image))) && $old_image!='default_profile.jpg')
            {
                Storage::disk('public')->delete('profile_images/'.$old_image);
            }
        }
        else if($request->input('delete_profile_image')==1)
        {

            $old_image=$user->profile_image;
            if(is_file((storage_path('app/public/profile_images/'.$old_image))) && $old_image!='default_profile.jpg')
            {
                Storage::disk('public')->delete('profile_images/'.$old_image);
            }
            $user->update(['profile_image'=>'default_profile.jpg']);

        }
        return redirect(route('profile.user_profile'));

    }

    public function edit_profile()
    {
        return view('profile.edit_profile');
    }
    public function user_profile()
    {
        $user=Auth::user();
        return view('profile.user_profile',compact('user'));
    }

    public function show_user($user_id)
    {
        $user=User::findOrFail($user_id);
        return view('profile.show_user',compact('user'));
    }

    public function follow($user_id)
    {
        Auth::user()->following()->attach($user_id);
    }
    public function un_follow($user_id)
    {
        Auth::user()->following()->detach($user_id);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|string|min:6|confirmed',
        ]);

        if(Hash::check($request->input('old_password'), Auth::user()->getAuthPassword()))
        {
            Auth::user()->fill([
                'password' => Hash::make($request->input('password'))
            ])->save();
            return redirect(route('profile.user_profile'));
        }
        else
        {
            $wrong_password=__('text.Old password is not correct');
            return redirect(route('profile.edit_profile'))->withErrors(['old_password'=>$wrong_password]);
        }
    }



    public function search(Request $request)
    {
        $user=User::where('username','=',$request->input('search_user'))->first();

        if($user==null)
        {
            $no_find=1;
        }
        return view('search.users_search',compact('user','no_find'));
    }



}

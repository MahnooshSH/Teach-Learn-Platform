<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function change_language($locale)
    {
        if($locale=='en' || $locale=='fa') {
            Auth::user()->user_setting()->update(['language' => $locale]);
        }

        return redirect()->back();
    }
}

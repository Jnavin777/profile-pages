<?php

namespace Profiles;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(int $id)
    {
        $user = User::findOrFail($id);
        return view('calculator::add', compact('user'));
    }

    public function myProfile()
    {
        dd(Auth::user());
        return response()->json();
    }
}

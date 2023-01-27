<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function create()
    {
       return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['nullable', 'string', Password::default()],
        ]);

        if ( $credentials['password'] && Auth::attempt($credentials) )
        {
            if ( Auth::check() && auth()->user()->isVerified() )
            {
                $request->session()->regenerate();
                return to_route('admin.dashboard');
            } elseif ( Auth::check() && ! auth()->user()->isVerified() )
            {
                $request->user()->sendOtpEmailVerificationNotification(User::findOrFail($credentials['email']));
                return to_route('admin.verify', ['id' => Auth::id()]);
            }
        } else {
            $user = User::where('email', $credentials['email'])->first();
            $user->sendOtpEmailVerificationNotification($user);
//            $otp = $request->user()->generateOtp(User::findOrFail($credentials['email']));
            return to_route('admin.verify', ['id' => $user->id]);

        }
    }
}

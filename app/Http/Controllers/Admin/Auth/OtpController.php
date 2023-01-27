<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function create(Request $request)
    {
        return view('admin.auth.verify')->with(['id' => $request->id]);
    }

    public function store(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate(['otp_code']);
        if ( $user->verifyOtp($user, $request->otp_code) )
        {
            Auth::login($user);
            if ( ! Auth::user()->isVerified() )
            {
                Auth::user()->markAsVerified();
                return to_route('admin.dashboard', '?verified=1');
            }
            return to_route('admin.dashboard');
        } else {
            return back()->with(['error' => 'Otp Code Invalid!']);
        }
    }

    public function resendOtp(Request $request)
    {
        $request->user()->sendOtpEmailVerificationNotification(User::findOrFail($request->id));
        return back()->with(['success' => 'Otp Code Sent!']);
    }
}

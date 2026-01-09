<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function show()
    {
        return view('auth::forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        // Logic here
        return "Reset Link Logic Implemented Later";
    }
}

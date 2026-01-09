<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth::login');
    }

    public function login(Request $request)
    {
        // Login logic here
        return "Login Logic Implemented Later";
    }
}

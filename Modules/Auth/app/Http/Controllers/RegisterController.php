<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth::register');
    }

    public function register(Request $request)
    {
        // Register logic here
        return "Register Logic Implemented Later";
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('templates.pages.content.login');
    }

    public function store(Request $request) {
        
    }
}

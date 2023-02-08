<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    public function register()
    {
        return view('auth.register-tenant');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}

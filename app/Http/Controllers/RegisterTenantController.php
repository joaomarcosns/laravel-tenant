<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    public function register()
    {
        return view('auth.register-tenant');
    }

    public function store(Request $request)
    {
        $tenant = Tenant::query()->create($request->all());
        $tenant->createDomain(['domain' => $request->domain]);

        dd($tenant);
    }
}

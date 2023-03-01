<?php

declare(strict_types=1);

use App\Http\Livewire\Tenants\RestaurantMenu\Index;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('restaurants/menu')->name('restaurants.menu.')->group(function(){
        Route::get('/', Index::class)->name('index');
    });
    Route::get('/photo/{path}', function ($path) {
        $image = str_replace('|', '/', $path);
        $path = storage_path('app/public/' . $image);

        $mimeType = \Illuminate\Support\Facades\File::mimeType($path);

        return response(file_get_contents($path))->header('Content-type', $mimeType);
    })->name('server.image');
    require __DIR__.'/auth.php';
});

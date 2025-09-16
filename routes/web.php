<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/html', function () {
    return view('html');
});

//Route::get('/', function () {
//    return (! Auth::check()) ? view('auth.login') : Redirect::to(getDashboardURL());
//})->name('login');

Route::middleware('auth', 'xss')->group(function () {
    // Update profile
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.setting');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('update.profile.setting');
    Route::get('user/profile/edit', [UserController::class, 'userEditProfile'])->name('user.profile.setting');
    Route::put('/change-user-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/change-language', [UserController::class, 'changeLanguage'])->name('change.language');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
require __DIR__.'/landing.php';
require __DIR__.'/upgrade.php';

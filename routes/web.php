<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ViewProjectController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\NewProjectFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

    Route::get('/logout', [SessionsController::class, 'destroy']);

	Route::get('/profile', [InfoUserController::class, 'create'])->name('create.profile');
	Route::post('/profile', [InfoUserController::class, 'store']);
	Route::post('/profile', [InfoUserController::class, 'update'])->name('edit.profile');
	// Route::get('/edit-profile', [UpdateProfileController::class, 'edit'])->name('profile.edit');
	// Route::post('/edit-profile', [UpdateProfileController::class, 'update'])->name('profile.update');
	
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	Route::get('/create-project', [NewProjectFormController::class, 'create'])->name('create.form');
	Route::post('/create-project', [NewProjectFormController::class, 'store'])->name('create.store');
	
	Route::get('/view-project/{id}', [ViewProjectController::class, 'index']);

	Route::get('/show-post', [PostController::class, 'index']);
	Route::post('/create-post', [PostController::class, 'store']);

});

Route::get('/auth/redirect', [authController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/callback', [authController::class, 'callback'])->name('google.callback');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('create.register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
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
use App\Http\Controllers\SetupProjectController;
use App\Http\Controllers\ResultProjectController;
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

Route::middleware(['IsActive'])->group(function( ) {
	Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

	Route::get('/profile', [InfoUserController::class, 'create'])->name('create.profile');

	Route::get('/create-project', [NewProjectFormController::class, 'create'])->name('create.form');
	Route::post('/create-project', [NewProjectFormController::class, 'store'])->name('create.store');

	Route::get('/view-project/{id}', [ViewProjectController::class, 'index'])->name('view.project');
	Route::match(['get', 'put'], '/view-project/update-label{id}', [ViewProjectController::class, 'updateDataset'])->name('update.dataset');
	// Route::delete('/view-project/delete-label/{id}', [ViewProjectController::class, 'deleteDataset'])->whereNumber('id')->name('delete.dataset');

	Route::post('/add-collaborator/{id}', [ViewProjectController::class, 'addCollaborator'])->whereNumber('id')->name('add.collaborator');

	Route::get('/result-project/{id}', [ResultProjectController::class, 'index'])->name('result-project');

	Route::post('/execute-python', [ResultProjectController::class, 'executePythonScript'])->name('execute.python');
});

Route::get('/', [SessionsController::class, 'index'])->name('home');
Route::get('/auth/redirect', [authController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/callback', [authController::class, 'callback'])->name('google.callback');
Route::get('/register', [RegisterController::class, 'create'])->name('create.register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/login', [authController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');
Route::post('/session', [SessionsController::class, 'store']);

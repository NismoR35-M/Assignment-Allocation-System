<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAssignmentController;
use App\Http\Controllers\GraphController;
   
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

Route::get('/', function () {
    return view('welcome');
});

         

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
// Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	// Route::get('user-management', function () {
	// 	return view('pages.laravel-examples.user-management');
	// })->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});

//Assignments
Route::get('/tables', [AssignmentController::class,'index'])->name('tables');
Route::patch('/assignments/{id}/status/{status}', [AssignmentController::class, 'update'])->name('update.status');
Route::get('/assignments/{id}',[AssignmentController::class,'show'])->name('assignment_show');


Route::middleware(['web', 'admin'])->group(function () {
    //Admin Routes

    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.login.store');
	Route::get('/admin/profile', [AdminController::class, 'create'])->name('admin.profile');
	Route::post('/admin/profile', [AdminController::class, 'update'])->name('admin.postProfile');

    // Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    // Route::put('/admin/update/{id}', [AdminController::class, 'adminUpdate'])->name('admin.profile.update');
    // //admin dash
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


// ADMIN
// Route to view the details of an assignment
Route::get('/admin/viewAssignments', [AdminAssignmentController::class, 'create'])->name('create_assignment');
//Route::post('/assignments/assign', [AdminAssignmentController::class, 'assign'])->name('assign_assignments');
Route::post('/save-assignment', [AdminAssignmentController::class, 'assignAssignment'])->name('assign_assignment');
Route::get('/admin/assignments', [AdminAssignmentController::class, 'shows'])->name('show_assignments');
Route::get('/admin/view/members', [AdminAssignmentController::class, 'show_users'])->name('show_users');

Route::get('users/create', [AdminAssignmentController::class, 'createForm'])->name('admin.addUser');
Route::post('users/create', [AdminAssignmentController::class, 'createUser'])->name('admin.users.save');
Route::delete('users/{id}', [AdminAssignmentController::class, 'deleteUser'])->name('admin.users.delete');

Route::get('/member-activity', [GraphController::class, 'memberActivity'])->name('member_activity');

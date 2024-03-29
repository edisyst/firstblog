<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Group Middleware
Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/profile', [\App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/update', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/changepassword', [\App\Http\Controllers\AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::post('/admin/changepassword', [\App\Http\Controllers\AdminController::class, 'updatePassword'])->name('admin.update.password');
});

// Agent Group Middleware
Route::middleware(['auth', 'role:agent'])->group(function (){
Route::get('/agent/dashboard', [\App\Http\Controllers\AgentController::class, 'dashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');

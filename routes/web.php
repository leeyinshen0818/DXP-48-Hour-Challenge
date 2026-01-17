<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/actions', [AdminController::class, 'actions'])->name('admin.actions');
Route::post('/admin/actions/generate-email', [AdminController::class, 'generateAiEmail'])->name('admin.generate.email');
Route::post('/admin/actions/generate-content', [AdminController::class, 'generateAiContent'])->name('admin.generate.content');
Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

// Public Program Routes
Route::get('/programs', function () {
    return view('programs.index');
})->name('programs.index');

Route::get('/programs/software-engineering', function () {
    return view('programs.show');
})->name('programs.show');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');

})->name('welcome');

Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Quick logout for prototype
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UrlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|--------------------------------------------------------------------------
*/

// ================== Public Routes ==================

// Login and Logout Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes for Invited Users
Route::get('/signup/{token}', [RegistrationController::class, 'showSignupForm'])->name('signup');
Route::post('/signup/{token}', [RegistrationController::class, 'register'])->name('signup.submit');

// URL Redirection Route (Public)
Route::get('/{shortUrl}', [UrlController::class, 'redirect'])->name('urls.redirect');

// ================== Protected Routes (Authenticated) ==================
Route::middleware(['auth'])->group(function () {
    
    // ---------- Super Admin Routes ----------
    Route::middleware(['role:1'])->group(function () {
        Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
        Route::post('/superadmin/invite', [SuperAdminController::class, 'invite'])->name('superadmin.invite');
        Route::get('/superadmin/invite/delete/{id}', [SuperAdminController::class, 'inviteDelete'])->name('superadmin.invite.delete');
        Route::get('/superadmin/urls/download', [SuperAdminController::class, 'downloadUrls'])->name('superadmin.urls.download');
            
        Route::get('/superAdmin/my-urls', [SuperAdminController::class, 'viewUrls'])->name('superAdmin.urls.index');
        Route::get('/superAdmin/shorten', [UrlController::class, 'superAdminCreate'])->name('superAdmin.urls.create');
        Route::post('/superAdmin/shorten', [UrlController::class, 'superAdminStore'])->name('superAdmin.urls.store');
        Route::delete('/superAdmin/my-urls/{id}', [UrlController::class, 'superAdminDestroy'])->name('superAdmin.urls.destroy');
    });

    // ---------- Admin Routes ----------
    Route::middleware(['role:2'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/dashboard/Teams', [AdminController::class, 'teamDashboard'])->name('admin.dashboard.team');
        Route::post('/admin/invite', [AdminController::class, 'inviteMember'])->name('admin.invite');
        Route::get('/admin/team-urls', [AdminController::class, 'viewTeamUrls'])->name('admin.team-urls');
        Route::get('/admin/urls/download', [AdminController::class, 'downloadUrls'])->name('admin.urls.download');
        
        Route::get('/admin/my-urls', [UrlController::class, 'adminIndexSingle'])->name('admin.urls.index.single');
        Route::get('/admin/team-urls', [UrlController::class, 'adminIndexTeam'])->name('admin.urls.index.team');
        Route::get('/admin/shorten', [UrlController::class, 'adminCreate'])->name('admin.urls.create');
        Route::post('/admin/shorten', [UrlController::class, 'adminStore'])->name('admin.urls.store');
        Route::delete('/admin/my-urls/{id}', [UrlController::class, 'adminDestroy'])->name('admin.urls.destroy');
    });

    // ---------- Member Routes ----------
    Route::middleware(['role:3'])->group(function () {
        
    Route::get('/members/my-urls', [UrlController::class, 'index'])->name('member.urls.index');
    Route::get('/member/shorten', [UrlController::class, 'memberCreate'])->name('member.urls.create');
    Route::post('/member/shorten', [UrlController::class, 'store'])->name('urls.store');
    Route::delete('/member/my-urls/{id}', [UrlController::class, 'destroy'])->name('urls.destroy');
    });
});

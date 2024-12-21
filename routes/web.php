<?php

use App\Http\Controllers\GymController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/membership', function () {
    return Inertia::render('Membership');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'insert'])->name('users.insert');
    // Route::delete('/users/{id}',[UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/gym', [GymController::class, 'index'])->name('gym.index');
    Route::post('gym', [GymController::class, 'store'])->name('gym.insert');
    Route::delete('/gym/{gym}', [GymController::class, 'destroy'])->name('gym.destroy');
    Route::get('/gym/create', [GymController::class, 'create'])->name('gym.create');
    Route::get('/gym/{gym}/edit', [GymController::class, 'edit'])->name('gym.edit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::post('/member', [MemberController::class, 'store'])->name('member.insert');
    Route::delete('/member/{member}', [MemberController::class, 'destroy'])->name('member.destroy');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

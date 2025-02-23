<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamRequestController;
use App\Models\Team;

Route::get('/', function () {
    $teams = Team::all(); // Fetch all teams
    return view('welcome', compact('teams'));
})->name('welcome');

Route::post('/team-request/store', [TeamRequestController::class, 'store'])->name('team.request.store');

Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth.form');



Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/add-team', [AdminController::class, 'addTeam'])->name('add.team');
Route::post('/add-team', [AdminController::class, 'storeTeam'])->name('store.team');
Route::get('/manage-teams', [AdminController::class, 'manageTeams'])->name('manage.team');
Route::get('/edit-team/{id}', [AdminController::class, 'editTeam'])->name('edit.team');
Route::post('/update-team/{id}', [AdminController::class, 'updateTeam'])->name('update.team');
Route::delete('/delete-team/{id}', [AdminController::class, 'deleteTeam'])->name('delete.team');
Route::get('/team-requested', [AdminController::class, 'teamRequested'])->name('team.requested');
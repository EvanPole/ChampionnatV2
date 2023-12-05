<?php

use App\Http\Controllers\ChampionnatController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MatchController;
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

Route::get('/dashboard', function () {
    return redirect()->route('championnat.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('championnat', ChampionnatController::class)->middleware(['auth', 'verified']);

Route::resource('equipe', EquipeController::class)->middleware(['auth', 'verified']);

Route::resource('joueur', JoueurController::class)->middleware(['auth', 'verified']);

Route::resource('match', MatchController::class)->middleware(['auth', 'verified']);

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->middleware(['auth', 'verified'])->name('change.language');

Route::get('/', function () {
    return redirect('login');
});

Route::get('test', function () {
    return view('test');
});

require __DIR__.'/auth.php';

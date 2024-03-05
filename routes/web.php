<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\AchievementController;

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
//profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    
//games
    Route::get('/games/create', [GamesController::class, 'create'])->name('games.create');
    Route::post('/games/data',[GamesController::class, 'data'])->name('games.data');
    Route::get('games/edit/{id}', [GamesController::class, 'edit'])->name('games.edit');
    Route::post('games/update/{id}', [GamesController::class, 'update'])->name('games.update');
    Route::delete('games/delete/{id}', [GamesController::class, 'delete'])->name('games.delete');

//friends
    Route::get('friends', [FriendsController::class, 'index'])->name('friends.index');
    Route::get('friends/addfriend/{id}', [FriendsController::class, 'addfriend'])->name('friends.addfriend');
    Route::get('friends/acceptfriend/{id}', [FriendsController::class, 'acceptfriend'])->name('friends.accept');
    Route::get('friends/declinefriend/{id}', [FriendsController::class, 'declinefriend'])->name('friends.decline');
    
//achievements
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievement.index');

//messages
    Route::get('/messages/{receiver}', [MessagesController::class, 'index'])->name('messages.index');
    Route::post('/messages/send/{receiver}', [MessagesController::class, 'sendbericht'])->name('messages.sendbericht');
});

//public games
Route::get('/games', [GamesController::class, 'index'])->name('games.index');





require __DIR__.'/auth.php';

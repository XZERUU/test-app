<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Notifications\UserNotification;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');

});


/* Activity 5 - Laravel Notifications */
Route::get('/notify', function () {

    $user = User::first();
    $user->notify(new UserNotification());

    return view('notifications.notify');

});


/* Activity 6 - Laravel Eloquent ORM */
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);


/* Activity 7 - Laravel File Management */
Route::get('/upload',[FileController::class,'index'])->name('file.index');
Route::post('/upload',[FileController::class,'upload'])->name('file.upload');


require __DIR__.'/auth.php';
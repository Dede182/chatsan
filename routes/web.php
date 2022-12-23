<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('/chats',[ChatController::class,'index']);
    Route::get('/chats/{userId}',[ChatController::class,'user'])->name('chats.index');
    Route::post('/chats/{userId}',[ChatController::class,'send'])->name('chats.send');
    Route::delete('/chats/{id}',[ChatController::class,'destroy'])->name('chats.delete');


require __DIR__.'/auth.php';

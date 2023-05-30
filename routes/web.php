<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Http\Middleware\IsAdmin;
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

Route::get('/usual', function () {
    return view('usual');
})->name('usual');
Route::get('/unusual', function () {
    return view('unusual');
})->name('unusual');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


//Route::middleware('auth')->group(function () {
	Route::get('/book/index', [BookController::class, 'index'] )->name('book.index');
	Route::get('/book/{book}', [BookController::class, 'show'] )->name('book.show');
	Route::get('/book/destroy/{book}', [BookController::class, 'destroy'] )->name('book.destroy')->middleware(IsAdmin::class);
	Route::get('/book/edit/{book}', [BookController::class, 'edit'] )->name('book.edit');
	Route::get('/book/detach/{book}/{author}', [BookController::class, 'detachAuthor'] )->name('book.detach');
	Route::get('/book/attach/{book}/{author}', [BookController::class, 'attachAuthor'] )->name('book.attach');
	Route::post('/book/store', [BookController::class, 'store'] )->name('book.store');
	Route::post('/book/update/{book}', [BookController::class, 'update'] )->name('book.update')->middleware(IsAdmin::class);
	Route::get('/author/index', [AuthorController::class, 'index'] )->name('author.index');
	Route::post('/author/search', [AuthorController::class, 'search'] )->name('author.search');
//});





Route::get('/dashboard', function () {
	// $h = Hash::make('1234');
	// Auth::user()->update(['password'=>$h]);
	// $c = Crypt::encryptString('salam, yek dadeye mohem!');
	// $p = Crypt::decryptString($c);
	$user_id = Auth::user()->id;
    return view('dashboard',['user_id'=>$user_id]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

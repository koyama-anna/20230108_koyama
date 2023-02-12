<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;
use App\Models\Tag;
use App\Models\User;

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

Route::get('/', [TodoController::class, 'index'])->middleware(('auth'));
Route::post('/create', [TodoController::class, 'create']);
Route::post('/update', [TodoController::class, 'update']);
Route::get('/remove', [TodoController::class, 'remove']);
Route::post('/remove', [TodoController::class, 'remove']);
Route::get('/find', [TodoController::class, 'find']);
Route::get('/search', [TodoController::class, 'search']);
Route::post('/search', [TodoController::class, 'search']);

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/dashboard', function () {
    $user = Auth::user();
    $todos = Todo::all();
    $param = ['todos' => $todos, 'user' => $user];
    return view('index', $param);
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';

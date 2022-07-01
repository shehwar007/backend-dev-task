<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;


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

Route::get('/', [AuthController::class, 'index']);
Route::post('loginSubmit', [AuthController::class, 'validateCredentials'])->name('login.submit');
Route::get('/logout', function () {
        session()->flush();
        return redirect('/');
})->name('logoutname');


Route::group(['middleware' => ['loginCheck']], function () {



Route::get('/dashboard', function () {
  
  
    return view('dashboard');
   
})->name('home.dashboard');

Route::post('/test', function (Request $request) {
  dd($request->all());
})->name('test.submit');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/user', [UserController::class, 'insertUser'])->name('user.store');
Route::get('/get_user', [UserController::class, 'viewUser'])->name('user.getdata');
Route::get('/edit_user/{id}', [UserController::class, 'editUser']);
Route::post('/update_user', [UserController::class, 'updateUser'])->name('user.update');
Route::get('/delete_user/{id}', [UserController::class, 'deleteUser']);

Route::get('/blog', [BlogController::class, 'index'])->name('blog.view');
Route::post('/blog', [BlogController::class, 'insertBlog'])->name('blog.store');
Route::get('/get_blog', [BlogController::class, 'viewBlog'])->name('blog.getdata');
});



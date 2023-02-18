<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCtrl;
use App\Http\Controllers\AuthCtrl;
use App\Http\Controllers\ScoreCtrl;
use App\Http\Controllers\QuestionCtrl;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Auth login
Route::post('login',[AuthCtrl::class, 'login'])->name('login'); 

//Auth logout
Route::middleware('auth:sanctum')->post('logout',[AuthCtrl::class, 'logout']); 

//Auth get user
Route::middleware('auth:sanctum')->get('getuser',[AuthCtrl::class, 'getuser']); 



//get all users
Route::get('users',[UserCtrl::class, 'index'])->name('index');

//create new user
Route::post('user', [UserCtrl::class, 'create'])->name('create');

//Update User
Route::put('update-user/{id}',[UserCtrl::class, 'store'])->name('store');

//Find One User
Route::get('user/{id}', [UserCtrl::class, 'show'])->name('show');

//deleted user
Route::delete('user/{id}', [UserCtrl::class, 'destroy'])->name('destroy'); 



//get scores
Route::get('score/{id}', [ScoreCtrl::class, 'index'])->name('score');
//post scores
Route::post('score', [ScoreCtrl::class, 'create'])->name('createScore');


//get Subject
Route::get('subject', [QuestionCtrl::class, 'index'])->name('subject');

//create subject
Route::middleware('auth:sanctum')->post('subject', [QuestionCtrl::class, 'create'])->name('createSubject');


//get Question Test
Route::get('subject/{id}', [QuestionCtrl::class, 'show'])->name('getTest');

//create question
Route::post('quest', [QuestionCtrl::class, 'createQuest'])->name('createQuest');

//create answer
Route::post('answered', [QuestionCtrl::class, 'createAns'])->name('createAns');

//delete answer
Route::delete('answered/{id}', [QuestionCtrl::class, 'deleteQst'])->name('deleteQst');
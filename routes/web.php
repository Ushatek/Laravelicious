<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UzytkownicyController;
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


Route::get('/', [HomeController::class, 'index'] );

Route::get('/menu', [MealsController::class, 'index'] );
Route::post('/menu', [MealsController::class, 'post'] );
Route::get('/menu/dodawanie', [MealsController::class, 'create'] );
Route::post('/menu/dodawanie', [MealsController::class, 'addToDB'] );
Route::get('/menu/edycjarodzaju/{id}', [MealsController::class, 'editType'] );
Route::post('/menu/edycjarodzaju/{id}', [MealsController::class, 'updateType'] );
Route::get('/menu/dodawanierodzaju', [MealsController::class, 'createType'] );
Route::post('/menu/dodawanierodzaju', [MealsController::class, 'addTypeToDB'] );
Route::get('/menu/edycja/{id}', [MealsController::class, 'edit'] );
Route::post('/menu/edycja/{id}', [MealsController::class, 'update'] );
Route::get('/menu/usun/{id}', [MealsController::class, 'delete'] );

Route::post('/menu/dodawanie/validateModel', [MealsController::class, 'validateModel']);

Route::get('/logowanie', [UzytkownicyController::class, 'index'] );
Route::post('/logowanie', [UzytkownicyController::class, 'loginUser'] );
Route::get('/rejestracja', [UzytkownicyController::class, 'create'] );
Route::post('/rejestracja/validateModel', [UzytkownicyController::class, 'validateModel']);
Route::post('/rejestracja', [UzytkownicyController::class, 'addToDB'] );
Route::get('/logout', [UzytkownicyController::class, 'logoutUser'] );

Route::get('/zamowienia', [OrdersController::class, 'index'] );
Route::get('/zamowienia/zobacz/{id}', [OrdersController::class, 'details'] );
Route::get('/zamowienia/edycja/{id}', [OrdersController::class, 'edit'] );
Route::post('/zamowienia/edycja/{id}', [OrdersController::class, 'update'] );
Route::get('/zamowienia/anuluj/{id}', [OrdersController::class, 'cancel'] );
Route::get('/zamowienia/oplac/{id}', [OrdersController::class, 'pay'] );
Route::get('/zamowienia/usun/{id}', [OrdersController::class, 'delete'] );


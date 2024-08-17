<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TbllivrosController;

Route::get('/user', function(Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function() {
    return Response()->json(['Sucesso'=>true]);
});

Route::get('/livros',[TbllivrosController::class,'index']); 

Route::get('/livros/{id}',[TbllivrosController::class,'show']);

Route::post('/livros',[TbllivrosController::class,'store']);

Route::put('/livros/{id}',[TbllivrosController::class,'update']);

Route::delete('/livros/{id}',[TbllivrosController::class,'destroy']);

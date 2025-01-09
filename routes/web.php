<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['message' => 'Welcome to the API'];
});

Route::get('/status', function () {
    return response()->json(['status' => 'API funcionando!']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
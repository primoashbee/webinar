<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

Route::get('/test', function(Request $request){
    return response()->json(['message'=>'Test'], 200);
});

Route::post('/auth', function(Request $request){
    $validator = Validator::make($request->all(), [
        'email'=>'required',
        'password'=>'required',
    ]);
    if($validator->fails()){
        return response()->json(['data'=>$validator->errors()],422);
    }
    $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    if($attempt){
        return response()->json(['message'=>'Success','user'=>Auth::user()],200);
    }
});

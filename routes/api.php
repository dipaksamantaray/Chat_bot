<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/chatbot', function (Request $request) {
    $userMessage = $request->input('message');
    $botResponse = '';

    // Basic chatbot logic (You can customize or replace this with a real chatbot service)
    if (str_contains(strtolower($userMessage), 'hello')) {
        $botResponse = 'Hello! How can I assist you today?';
    } elseif (str_contains(strtolower($userMessage), 'how are you')) {
        $botResponse = 'I\'m a bot, but I\'m doing great! How can I help you?';
    } elseif (str_contains(strtolower($userMessage), 'who is dipak')){
        $botResponse = "dipak is a fullstack developer";
}else {
        $botResponse = 'Sorry, I didn\'t understand that. Can you ask something else?';
    }

    return response()->json([
        'response' => $botResponse
    ]);
});
<?php

/*use Illuminate\Http\Request;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@likeIt');
Route::delete('/unlike/{reply}', 'LikeController@unlikeIt');

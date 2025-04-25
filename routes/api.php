<?php

use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(ImageController::class)->group(function () {
    Route::post('images', 'addImage');
    Route::get('images', 'getImage');
    Route::get('/images/{id}', 'getImageById');
    Route::post('/images/{id}', 'updateImageById');
    Route::delete('/images/{id}', 'deleteImageById');
});

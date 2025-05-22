<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use Illuminate\Support\Facades\Log;

$callback = function () {
    try {
        $imagenes = Image::all();
    } catch (\Exception $e) {
        Log::error('Error al obtener imágenes: ' . $e->getMessage());
        $imagenes = [];
    }

    return view('home', compact('imagenes'));
};

Route::get('/', $callback);
Route::get('/images', $callback);

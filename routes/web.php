<?php

use App\Models\Image;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $imagenes = Image::all();
    return view('home', compact('imagenes'));
});

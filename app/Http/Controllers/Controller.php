<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use function Laravel\Prompts\error;

class Controller extends Controller
{
    public function addImage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|min:10|max:100',
                'image_route' => 'required|mimes:png,jpg,jepg|max:4096',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $rutaImg = $request->file('image_route')->store('myimages');
        $image = new Image();
        $image->title = $request->title;
        $image->image_route = $rutaImg;
        $image->save();
        return response()->json(['message' => 'Imagen cargada con éxito', 201]);
    }
    public function getImage()
    {
        $images = Image::all();
        if ($images->isEmpty()) {
            return response()->json(['message' => 'No se ha encontrado ninguna imagen'], 404);
        }
        foreach ($images as $img) {
            $img->image_route = asset(Storage::url($img->image_route));
        }
        return response()->json($images, 200);
    }

    public function getImageById($id)
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Imagen no encontrada'], 404);
        }
        $image->image_route = asset(Storage::url($image->image_route));
        return response()->json($image, 200);
    }

    public function updateImageById(Request $request, $id)
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Imagen no encontrada'], 404);
        }
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'nullable|string|min:10|max:100',
                'image_route' => 'required|mimes:png,jpg,jepg|max:4096',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        if ($request->has('title')) {
            $image->title = $request->title;
        }
        if ($request->hasFile('image_route')) {
            if ($image->image_route && Storage::exists($image->image_route)) {
                Storage::delete($image->image_route);
            }
            $rutaImg = $request->file('image_route')->store('myimages');
            $image->image_route = $rutaImg;
        }
        $image->update();
        return response()->json(['message' => 'Image updated successfully'], 200);
    }
    public function deleteById($id)
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }
        if ($image->image_route && Storage::exists($image->image_route)) {
            Storage::delete($image->image_route);
        }
        $image->delete();
        return response()->json(['message' => 'Imagen borrada'], 200);
    }
}

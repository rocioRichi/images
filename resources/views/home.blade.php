<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imágenes</title>
</head>
@vite(["resources/css/app.css"])
<body>
    <h1>Galería de imágenes</h1>

    <div>
        @foreach ($imagenes as $image)

                <img src="{{ asset('storage/' . $image->image_route) }}" width="200">

        @endforeach
        </div>
</body>
</html>

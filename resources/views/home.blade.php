<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imágenes</title>
</head>
<body>
    <h1>Galería de imágenes</h1>

    <ul>
        @foreach ($imagenes as $image)
            <li>
                <img src="{{ asset('storage/myimages' . $image->image_route) }}" width="200">
            </li>
        @endforeach
    </ul>
</body>
</html>

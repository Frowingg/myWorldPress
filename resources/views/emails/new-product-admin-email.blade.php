<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hi! A new product had benn added to de database.</h1>

    <h3>Title: {{ $new_product->title }}</h3>

    <a href="{{ route('admin.products.show', ['product' => $new_product->id]) }}">Click here to see the product.</a>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Test Page</h1>
    <p>This is a test page to demonstrate Blade templating in Laravel.</p>

    <p>Current Date and Time: {{ now() }}</p>

    <ul>
        @foreach($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
<h2>urgent task</h2>
    <p>Thank you for visiting!</p>
</body>
</html>

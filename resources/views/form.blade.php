<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form </title>
</head>

<body>
    <h1>day 1</h1>
    <!-- form.blade.php -->
    <form method="POST" action="/submit">
        @csrf
        <input type="text" name="username" placeholder="Enter name">
        <button type="submit">Submit</button>
    </form>

</body>

</html>

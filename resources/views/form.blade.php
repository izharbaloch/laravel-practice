<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form </title>
</head>

<body>
    <h1>day 3</h1>
    <!-- form.blade.php -->
    <form action="{{ route('submitForm') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <button type="submit">Submit</button>
    </form>

</body>

</html>

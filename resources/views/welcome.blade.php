@extends('layouts.app')
@section('content')
    <div>
        <h1>Welcome Blade – Day 3 {!! $name !!}</h1>
    </div>

    <form action="{{ route('submitForm') }}" method="POST">
        @csrf
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @else
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection

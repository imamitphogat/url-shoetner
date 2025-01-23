@extends('layouts.app')

@section('title', 'Shorten URL')

@section('content')
    <div class="container">
        <h2>Shorten a New URL</h2>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Shorten URL Form -->
        <form action="{{ route('urls.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group mb-3">
                <label for="long_url">Enter Long URL:</label>
                <input type="url" name="long_url" id="long_url" class="form-control" placeholder="https://example.com"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Shorten URL</button>
        </form>
    </div>
@endsection

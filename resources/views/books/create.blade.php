@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2>Add New Book</h2>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title"
                    value="{{ old('title') }}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author" placeholder="Enter author"
                    value="{{ old('author') }}">
                @error('author')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="published_year">Published Year</label>
                <input type="number" name="published_year" class="form-control" id="published_year"
                    placeholder="Enter published year" value="{{ old('published_year') }}">
                @error('published_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" name="genre" class="form-control" id="genre" placeholder="Enter genre"
                    value="{{ old('genre') }}">
                @error('genre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
    
@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2>Edit Book</h2>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $book->title) }}"
                    placeholder="Enter title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author"
                    value="{{ old('author', $book->author) }}" placeholder="Enter author">
                @error('author')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="published_year">Published Year</label>
                <input type="number" name="published_year" class="form-control" id="published_year"
                    value="{{ old('published_year', $book->published_year) }}" placeholder="Enter published year">
                @error('published_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" name="genre" class="form-control" id="genre"
                    value="{{ old('genre', $book->genre) }}" placeholder="Enter genre">
                @error('genre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

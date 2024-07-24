@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Books List</h2>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Add Book Button -->
        <div class="mb-3 text-end">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
        </div>

        <!-- Books Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Year</th>
                        <th>Genre</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->published_year }}</td>
                            <td>{{ $book->genre }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a class="btn btn-primary mr-2" href="{{ route('books.edit', $book->id) }}">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {!! $books->links() !!}
        </div>
    </div>
@endsection

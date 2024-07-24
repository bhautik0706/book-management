<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all books
        $books = Book::paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|integer',
            'genre' => 'required',
        ]);

        // Create a new book
        Book::create($request->all());

        // Redirect to the books list with a success message
        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|integer',
            'genre' => 'required',
        ]);

        // Update the book details
        $book->update($request->all());

        // Redirect to the books list with a success message
        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        // Soft delete the book
        $book->delete();

        // Redirect to the books list with a success message
        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}

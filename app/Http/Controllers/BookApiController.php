<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookApiController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::all(); // Fetching all non-deleted records
        return response()->json([
            'success' => true,
            'data' => $books,
            'error' => null
        ]);
    }

    /**
     * Display the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = Book::find($id);

        if ($book) {
            return response()->json([
                'success' => true,
                'data' => $book,
                'error' => null
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'genre' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $book = Book::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $book,
            'error' => null
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Validate only the fields that might be updated
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'published_year' => 'sometimes|integer',
            'genre' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        // Update only the fields that are provided
        $book->update($request->only(['title', 'author', 'published_year', 'genre']));
        return response()->json([
            'success' => true,
            'data' => $book,
            'error' => null
        ]);
    }

    /**
     * Remove the specified book from storage (soft delete).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $book->delete(); // Soft delete
        return response()->json([
            'success' => true,
            'data' => null,
            'error' => 'Book deleted successfully'
        ]);
    }

    /**
     * Restore a soft-deleted book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $book = Book::withTrashed()->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $book->restore();
        return response()->json([
            'success' => true,
            'data' => $book,
            'error' => null
        ]);
    }

    /**
     * Permanently delete a soft-deleted book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($id)
    {
        $book = Book::withTrashed()->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $book->forceDelete(); // Permanently delete
        return response()->json([
            'success' => true,
            'data' => null,
            'error' => 'Book permanently deleted'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|boolean',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book,
        ], 201);
    }

    public function show(Book $book)
    {
        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|boolean',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Buku berhasil diperbarui',
            'data' => $book,
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderByDesc('created_at')->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.form', [
            'book' => new Book(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:100',
            'published_year' => 'nullable|string|max:10',
            'copies' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $validated['available_copies'] = $validated['copies'];
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('books.form', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:100',
            'published_year' => 'nullable|string|max:10',
            'copies' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $delta = $validated['copies'] - $book->copies;
        $book->fill($validated);
        $book->available_copies = max(0, $book->available_copies + $delta);
        $book->save();

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->loans()->whereNull('returned_at')->exists()) {
            return back()->with('error', 'Buku sedang dipinjam dan tidak bisa dihapus.');
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}

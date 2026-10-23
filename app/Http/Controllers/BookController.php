<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request) {
        //$books = Book::all();

        $search = $request->query('search');

        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->get();

        return view('index', compact('books'));
    }

    public function create() {
        return view('create');
    }
    
    public function edit($id) {
        $book = Book::findOrFail($id);

        return view('edit', compact('book'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0'
        ]);

        $validated['available_quantity'] = $validated['quantity'];

        Book::create($validated);

        return redirect(route('books.index'));
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0'
        ]);

        $validated['available_quantity'] = $validated['quantity'];

        $book->update($validated);

        return redirect(route('books.index'));
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect(route('books.index'));
    }

    public function borrow($id) {
        $book = Book::findOrFail($id);

        $book->decrement('available_quantity');

        return redirect(route('books.index'));
    }
}

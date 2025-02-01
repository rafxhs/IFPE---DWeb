<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(20);

        return view('books.index', compact('books'));
    }
    public function createWithId()
    {
        return view('books.create-id');
    }

    public function storeWithId(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpge,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = $imagePath;
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'category']);

        $users = User::all();

        return view('books.show', compact('book', 'users'));
    }

    public function createWithSelect()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }

    public function storeWithSelect(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');

            $data['cover_image'] = $imagePath;
        }

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function edit(Book $book)
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');

            $data['cover_image'] = $imagePath;
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function destroy(Book $book)
    {

        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso.');
    }
}

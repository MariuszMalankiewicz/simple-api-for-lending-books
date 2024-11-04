<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Client;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhereHas('client', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
        }

        $books = $query->with('client')->paginate(20);

        return response()->json($books);
    }
    public function show($id)
    {
        $book = Book::with('client')->findOrFail($id);
        
        return response()->json($book);
    }

    public function borrow($id, Request $request)
    {
        $book = Book::findOrFail($id);
        if ($book->is_borrowed) return response()->json(['error' => 'Book already borrowed'], 400);

        $client = Client::findOrFail($request->client_id);
        $book->is_borrowed = true;
        $book->client_id = $client->id;
        $book->save();

        return response()->json(['success' => 'Book borrowed successfully']);
    }

    public function return($id)
    {
        $book = Book::findOrFail($id);
        if (!$book->is_borrowed) return response()->json(['error' => 'Book is not borrowed'], 400);

        $book->is_borrowed = false;
        $book->client_id = null;
        $book->save();

        return response()->json(['success' => 'Book returned successfully']);
    }
}

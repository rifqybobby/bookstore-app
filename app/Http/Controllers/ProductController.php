<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sort
        $sort = $request->get('sort', 'title_asc');
        match ($sort) {
            'title_asc'   => $query->orderBy('title', 'asc'),
            'title_desc'  => $query->orderBy('title', 'desc'),
            'price_low'   => $query->orderBy('price', 'asc'),
            'price_high'  => $query->orderBy('price', 'desc'),
            default       => $query->orderBy('title', 'asc'),
        };

        $books = $query->paginate(9)->withQueryString();
        $categories = Book::distinct()->pluck('category');

        return view('products.index', compact('books', 'categories', 'sort'));
    }

    public function show(Book $book)
    {
        return view('products.show', compact('book'));
    }
}

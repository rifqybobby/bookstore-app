<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('book')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn($i) => $i->book->price * $i->quantity);
        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Book $book)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', '"' . $book->title . '" berhasil ditambahkan ke cart!');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['quantity' => 'required|integer|min:1|max:99']);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Jumlah item diperbarui.');
    }
}

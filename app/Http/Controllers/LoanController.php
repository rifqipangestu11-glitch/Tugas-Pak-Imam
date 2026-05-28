<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'user'])->latest()->paginate(12);

        return view('loans.index', compact('loans'));
    }

    public function borrow(Book $book)
    {
        if ($book->available_copies < 1) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(7),
            'fine_amount' => 0,
        ]);

        $book->decrement('available_copies');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }

    public function return(Loan $loan)
    {
        if ($loan->returned_at) {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $loan->returned_at = now();
        $loan->fine_amount = $loan->calculateFine();
        $loan->save();
        $loan->book->increment('available_copies');

        return back()->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($loan->fine_amount, 0, ',', '.'));
    }
}

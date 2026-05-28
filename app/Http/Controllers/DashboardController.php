<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::sum('available_copies');
        $borrowedBooks = Loan::whereNull('returned_at')->count();
        $overdueLoans = Loan::whereNull('returned_at')->where('due_date', '<', now())->count();
        $recentLoans = Loan::with(['book', 'user'])->latest()->take(6)->get();

        return view('dashboard.index', compact('totalBooks', 'availableBooks', 'borrowedBooks', 'overdueLoans', 'recentLoans'));
    }
}

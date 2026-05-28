<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'fine_amount',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateFine(): int
    {
        $compareDate = $this->returned_at ?? now();

        if ($compareDate->lte($this->due_date)) {
            return 0;
        }

        return $compareDate->diffInDays($this->due_date) * 2000;
    }

    public function getStatusTextAttribute(): string
    {
        if ($this->returned_at) {
            return 'Dikembalikan';
        }

        return $this->due_date->isPast() ? 'Terlambat' : 'Dipinjam';
    }

    public function getFineTextAttribute(): string
    {
        return 'Rp ' . number_format($this->calculateFine(), 0, ',', '.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Perpus',
            'email' => 'admin@perpus.test',
            'password' => 'password',
        ]);

        Book::insert([
            [
                'title' => 'Belajar Laravel 10',
                'author' => 'Fajar Nugraha',
                'publisher' => 'Edukasi Media',
                'isbn' => '978-602-1234-56-7',
                'published_year' => '2024',
                'copies' => 5,
                'available_copies' => 5,
                'description' => 'Panduan lengkap membuat aplikasi web dengan Laravel 10.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Manajemen Perpustakaan Sekolah',
                'author' => 'Rina Kurniawati',
                'publisher' => 'Pustaka Cerdas',
                'isbn' => '978-602-9876-54-3',
                'published_year' => '2023',
                'copies' => 4,
                'available_copies' => 4,
                'description' => 'Strategi mengelola perpustakaan sekolah dengan efisien.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pemrograman PHP & MySQL',
                'author' => 'Budi Santoso',
                'publisher' => 'Open Source',
                'isbn' => '978-602-0000-11-2',
                'published_year' => '2022',
                'copies' => 6,
                'available_copies' => 6,
                'description' => 'Dasar-dasar PHP dan MySQL untuk pemula.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

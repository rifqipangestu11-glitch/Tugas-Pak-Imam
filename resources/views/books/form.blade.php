@extends('layouts.app')

@section('content')
<div class="max-w-3xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">{{ $book->exists ? 'Edit Buku' : 'Tambah Buku' }}</h1>
        <p class="mt-1 text-sm text-slate-500">Isi informasi buku perpustakaan.</p>
    </div>

    <form action="{{ $book->exists ? route('books.update', $book) : route('books.store') }}" method="POST" class="space-y-5">
        @csrf
        @if($book->exists)
            @method('PUT')
        @endif

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Judul Buku</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" required class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" />
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Penulis</label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}" required class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Penerbit</label>
                <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" />
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Tahun Terbit</label>
                <input type="text" name="published_year" value="{{ old('published_year', $book->published_year) }}" class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Jumlah</label>
                <input type="number" name="copies" min="1" value="{{ old('copies', $book->copies ?? 1) }}" required class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" />
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100">{{ old('description', $book->description) }}</textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="rounded-3xl bg-cyan-600 px-6 py-3 text-sm font-semibold text-white hover:bg-cyan-500">Simpan</button>
            <a href="{{ route('books.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
        </div>
    </form>
</div>
@endsection

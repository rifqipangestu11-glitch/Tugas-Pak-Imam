@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Daftar Buku</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola koleksi buku perpustakaan sekolah.</p>
        </div>
        <a href="{{ route('books.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-cyan-500">Tambah Buku</a>
    </div>

    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
        <table class="min-w-full text-left text-sm text-slate-700">
            <thead class="border-b border-slate-200 bg-slate-50 text-slate-900">
                <tr>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Penulis</th>
                    <th class="px-4 py-3">Penerbit</th>
                    <th class="px-4 py-3">Tersedia</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr class="border-b border-slate-200 last:border-b-0">
                        <td class="px-4 py-4">{{ $book->title }}</td>
                        <td class="px-4 py-4">{{ $book->author }}</td>
                        <td class="px-4 py-4">{{ $book->publisher ?? '-' }}</td>
                        <td class="px-4 py-4">{{ $book->available_copies }} / {{ $book->copies }}</td>
                        <td class="px-4 py-4 space-x-2">
                            <a href="{{ route('books.edit', $book) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:border-cyan-500 hover:text-cyan-600">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full border border-rose-300 bg-rose-50 px-4 py-2 text-sm text-rose-700 hover:bg-rose-100">Hapus</button>
                            </form>
                            @if($book->available_copies > 0)
                                <form action="{{ route('books.borrow', $book) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="rounded-full bg-cyan-600 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-500">Pinjam</button>
                                </form>
                            @else
                                <span class="rounded-full bg-slate-100 px-3 py-2 text-xs text-slate-500">Stok Habis</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-slate-500">Belum ada buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $books->links() }}</div>
    </div>
</div>
@endsection

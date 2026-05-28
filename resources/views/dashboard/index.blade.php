@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Total Buku</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $totalBooks }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Buku Tersedia</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $availableBooks }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Sedang Dipinjam</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $borrowedBooks }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Terlambat</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $overdueLoans }}</p>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Peminjaman Terbaru</h2>
                <p class="mt-1 text-sm text-slate-500">Lihat status peminjaman terakhir.</p>
            </div>
            <a href="{{ route('loans.index') }}" class="text-sm font-semibold text-cyan-600 hover:text-cyan-500">Lihat semua</a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="border-b border-slate-200 text-slate-900">
                    <tr>
                        <th class="px-4 py-3">Buku</th>
                        <th class="px-4 py-3">Peminjam</th>
                        <th class="px-4 py-3">Tanggal Pinjam</th>
                        <th class="px-4 py-3">Tanggal Kembali</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLoans as $loan)
                        <tr class="border-b border-slate-200 last:border-b-0">
                            <td class="px-4 py-4">{{ $loan->book->title }}</td>
                            <td class="px-4 py-4">{{ $loan->user->name }}</td>
                            <td class="px-4 py-4">{{ $loan->borrowed_at->format('d M Y') }}</td>
                            <td class="px-4 py-4">{{ $loan->due_date->format('d M Y') }}</td>
                            <td class="px-4 py-4">{{ $loan->status_text }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-slate-500">Belum ada peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

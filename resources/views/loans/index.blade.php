@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Daftar Peminjaman</h1>
            <p class="mt-1 text-sm text-slate-500">Lihat semua transaksi peminjaman dan kembalikan buku sesuai jadwal.</p>
        </div>
        <span class="rounded-3xl bg-slate-100 px-4 py-2 text-sm text-slate-600">Denda Rp 2.000 / hari</span>
    </div>

    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
        <table class="min-w-full text-left text-sm text-slate-700">
            <thead class="border-b border-slate-200 bg-slate-50 text-slate-900">
                <tr>
                    <th class="px-4 py-3">Buku</th>
                    <th class="px-4 py-3">Peminjam</th>
                    <th class="px-4 py-3">Pinjam</th>
                    <th class="px-4 py-3">Jatuh Tempo</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Denda</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr class="border-b border-slate-200 last:border-b-0">
                        <td class="px-4 py-4">{{ $loan->book->title }}</td>
                        <td class="px-4 py-4">{{ $loan->user->name }}</td>
                        <td class="px-4 py-4">{{ $loan->borrowed_at->format('d M Y') }}</td>
                        <td class="px-4 py-4">{{ $loan->due_date->format('d M Y') }}</td>
                        <td class="px-4 py-4">{{ $loan->status_text }}</td>
                        <td class="px-4 py-4">{{ $loan->fine_text }}</td>
                        <td class="px-4 py-4">
                            @unless($loan->returned_at)
                                <form action="{{ route('loans.return', $loan) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="rounded-full bg-cyan-600 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-500">Kembalikan</button>
                                </form>
                            @else
                                <span class="rounded-full bg-slate-100 px-3 py-2 text-xs text-slate-500">Selesai</span>
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-slate-500">Belum ada transaksi peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $loans->links() }}</div>
    </div>
</div>
@endsection

@extends('layouts.admin_layout')
@section('content')
    <div class="my-6 sm:my-11">
        <div class="px-4 sm:ml-12">
            <h1 class="text-2xl sm:text-[30px] font-semibold">Laporan Transaksi</h1>
        </div>

        <!-- Table Header - Hidden on Mobile -->
        <div class="hidden sm:block mt-10">
            <div class="border-b border-black mx-4 sm:mx-12 pb-3">
                <ul class="grid grid-cols-6 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Nama Sponsor</li>
                    <li>Dana sponsorship</li>
                    <li>Tanggal pembayaran</li>
                    <li>Tanggal penarikan</li>
                    <li>
                        <a href="/admin/report/print" target="_blank" class="btn btn-primary">Cetak Laporan</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mobile Print Button -->
        <div class="sm:hidden px-4 mt-6">
            <a href="/admin/report/print" target="_blank" class="btn btn-primary w-full">Cetak Laporan</a>
        </div>

        <!-- Data Cards -->
        <div class="flex flex-col px-4 sm:px-12 mt-4">
            @foreach ($datas as $item)
                <!-- Mobile Card -->
                <div class="block sm:hidden border border-black rounded-lg my-4 p-4">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-semibold">Nama Event:</span>
                            <span>{{ $item->event->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Nama Sponsor:</span>
                            <span>{{ $item->sponsor->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Dana:</span>
                            <span>Rp. {{ $item->level->fund }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Tanggal Pembayaran:</span>
                            <span>{{ date('d/m/Y', strtotime($item->payment_date)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Tanggal Penarikan:</span>
                            <span>{{ date('d/m/Y', strtotime($item->withdraw_date)) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Desktop Row -->
                <div class="hidden sm:grid grid-cols-6 items-center border border-black rounded-lg my-4 py-3">
                    <h1 class="text-center">{{ $item->event->name }}</h1>
                    <h1 class="text-center">{{ $item->sponsor->name }}</h1>
                    <h1 class="text-center">Rp. {{ $item->level->fund }}</h1>
                    <h1 class="text-center">{{ date('d/m/Y', strtotime($item->payment_date)) }}</h1>
                    <h1 class="text-center">{{ date('d/m/Y', strtotime($item->withdraw_date)) }}</h1>
                    <div class="text-center">
                        <!-- Kosong untuk menjaga alignment -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
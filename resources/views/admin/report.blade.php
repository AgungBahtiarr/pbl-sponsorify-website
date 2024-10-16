@extends('layouts.admin_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[30px]">Laporan Transaksi</h1>
            {{-- <h1 class="font-semibold text-[#7f7f7f]">Apakah admin sudah menerima dana sponsorship?</h1> --}}
        </div>
        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-6 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Nama Sponsor</li>
                    <li>Dana sponsorship</li>
                    <li>Tanggal pembayaran</li>
                    <li>Tanggal penarikan</li>
                    <li>
                        <a href="/admin/report/print" target="_blank" class="btn btn-primary">Cetak Laporan</a
                            href="/admin/report/print">
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col">
            @foreach ($datas as $item)
                <div class="grid grid-cols-6 items-center mx-12 border border-black rounded-lg my-4 py-3">
                    <h1 class="text-center ">{{ $item->event->name }}</h1>
                    <h1 class="text-center ">{{ $item->sponsor->name }}</h1>
                    <h1 class="text-center ">Rp. {{ $item->level->fund }}</h1>
                    <h1 class="text-center">{{ date('d/m/Y', strtotime($item->payment_date)) }}</h1>
                    <h1 class="text-center">{{ date('d/m/Y', strtotime($item->withdraw_date)) }}</h1>
                    {{-- <div class="flex justify-center">
                        <div class="badge badge-neutral">{{ $item->payment->status }}</div>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
@endsection

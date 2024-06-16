@extends('layouts.sponsor_layout')
@section('content')
<div class="my-11">
    <div class="ml-12">
        <h1 class="font-semibold text-[40px]">Pembayaran</h1>
        <h1 class="font-semibold text-[20px] text-[#7f7f7f]">Segera lakukan sponsorshipmu!</h1>
    </div>
    <div class="mt-10">
        <div class="border-b border-black mx-12 pb-3">
            <ul class="grid grid-cols-4 text-center font-semibold">
                <li>Nama Event</li>
                <li>Dana sponsorship</li>
                <li>Status</li>
                <li>Tindakan</li>
            </ul>
        </div>
    </div>
    @foreach ($data as $item )
    <div class="flex flex-col">
        <div class="grid grid-cols-4 items-center mx-12 border border-black rounded-lg my-4 py-3">
            <h1 class="text-center ">{{ $item->event->name }}</h1>
            <h1 class="text-center ">{{ $item->total_fund }}</h1>
            @if ($item->id_payment_status==1)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-[#fbbf0f] font-semibold text-[#fbbf0f]">
                    Proses verifikasi
                </button>
            </div>
            @elseif ($item->id_payment_status==2)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-[#21be32] font-semibold text-[#21be32]">
                    Selesai
                </button>
            </div>
            @elseif ($item->id_payment_status==3)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-[#db3227] font-semibold text-[#db3227]">
                    Terkirim
                </button>
            </div>
            @endif

            <div class="flex justify-center">
                <a href="" class="flex font-semibold gap-2 bg-neutral text-white px-10 py-2 rounded-xl items-center">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <p>Bayar</p>
                </a>
            </div>
        </div>
    @endforeach

    </div>
</div>
@endsection

@extends('layouts.sponsor_layout')
@section('content')
    <div class="m-5 lg:mx-24">
        <div class="mb-7">
            <h1 class="text-[30px] font-semibold text-center">Assalamualaikum</h1>
            <h1 class="text-[#9f9f9f] text-center">Yuk cek berapa proposal yang sudah masuk di perusahaanmu</h1>
        </div>
        <div class="flex flex-col gap-3 justify-center mb-7 lg:flex-row lg:justify-between">
            <div class="flex flex-col items-center px-28  py-5 bg-neutral text-white rounded-2xl md:px-48">
                <h1 class="font-semibold">Proposal masuk</h1>
                <h1 class="text-5xl md:text-8xl font-semibold">{{count($proposalIn)}}</h1>
            </div>
            <div class="flex flex-col items-center px-28  py-5 bg-neutral text-white rounded-2xl md:px-48">
                <h1 class="font-semibold">Laporan selesai</h1>
                <h1 class="text-5xl md:text-8xl font-semibold">{{count($report)}}</h1>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row lg:justify-between">

            <div class="flex flex-col justify-start">
                <h1 class="font-semibold mb-7">Riwayat proposal</h1>

                @foreach ($history as $item)
                    <a href="/sponsor/event" class="border px-5 py-3 border-black rounded-2xl md:w-auto">
                        <div class="flex justify-between border px-5 py-3 border-black rounded-2xl md:w-[660px] lg:w-[510px]">
                            <div class="flex gap-3">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                    </div>
                                </div>
                                <div class="flex flex-col items-start">
                                    <h1 class="font-semibold">{{$item->event->name}}</h1>
                                    <h1>{{$item->event->email}}</h1>
                                </div>

                            </div>
                            <div class="btn btn-primary hidden md:flex md:items-center">
                                <h1>Di terima</h1>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="flex flex-col justify-start">
                <h1 class="font-semibold mb-7">Belum di respon</h1>
                <a href="/sponsor/history" class="border px-5 py-3 border-black rounded-2xl md:w-auto">
                @foreach ($proposalIn as $item)
                        <div class="flex justify-between border px-5 py-3 border-black rounded-2xl md:w-[660px] lg:w-[510px]">
                            <div class="flex gap-3">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                    </div>
                                </div>
                                <div class="flex flex-col items-start">
                                    <h1 class="font-semibold">Semarak</h1>
                                    <h1>kwu@gmail.com</h1>
                                </div>

                            </div>
                            <div class="btn btn-primary hidden md:flex md:items-center">
                                <h1>Di terima</h1>
                            </div>
                    </div>
                @endforeach
                </a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.event_layout')
@section('content')
<div class="m-5 lg:mx-">
    <div class="mb-7">
        <h1 class="text-[30px] font-semibold text-center">Assalamualaikum</h1>
        <h1 class="text-[#9f9f9f] text-center">Yuk cek berapa proposal yang sudah masuk di perusahaanmu</h1>
    </div>
    <div class="flex flex-col gap-2 lg:gap-36 justify-center mb-7 lg:flex-row lg:justify-center">
        <div class="flex flex-col items-center px-28  py-5 bg-neutral text-white rounded-2xl md:px-48">
            <h1 class="font-semibold">Proposal diajukan</h1>
            <h1 class="text-5xl md:text-8xl font-semibold">{{count($transactions)}}</h1>
        </div>
        <div class="flex flex-col items-center px-28  py-5 bg-neutral text-white rounded-2xl md:px-48">
            <h1 class="font-semibold">Laporan selesai</h1>
            <h1 class="text-5xl md:text-8xl font-semibold">{{count($reports)}}</h1>
        </div>
    </div>
    <div class="w-full flex flex-col gap-2 lg:flex-row justify-center lg:gap-36">
        <div class="w-[100%] lg:w-[39%]">
            <h1 class="font-semibold mb-2">Riwayat proposal diajukan</h1>
            @if (count($transactions) == 0)
                <div class="border border-black rounded-2xl h-auto flex justify-center">
                    <div class="badge-neutral w-28 h-10 flex justify-center m-8 items-center rounded-xl">
                        <h1 class="font-semibold">Tidak ada</h1>
                    </div>
                </div>
            @elseif (count($transactions) != 0)
                <div class="border border-black rounded-2xl h-auto">
                    @foreach ($transactions as $item)
                        <div class="flex justify-between border items-center border-black rounded-2xl m-4 p-4">
                            <div class="flex gap-3">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img
                                            src="{{url($item->event->image)}}"/>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start">
                                    <h1 class="font-semibold">{{$item->event->name}}</h1>
                                    <h1>{{$item->event->name}}</h1>
                                </div>
                            </div>
                            <div class="badge badge-warning hidden md:flex ">
                                <h1 class="m-3 font-semibold">{{$item->status->status}}</h1>
                            </div>
                        </div>
                    @endforeach
                    <div class="m-4 text-white font-semibold">
                        <a href="/event/status" class="bg-neutral px-3 py-2 rounded-xl">Lihat semua</a>
                    </div>
                </div>
            @endif
        </div>
        <div class="w-[100%] lg:w-[39%]">
            <h1 class="font-semibold mb-2">Laporan yang di ajukan</h1>
            @if (count($reports) == 0)
                <div class="border border-black rounded-2xl h-auto flex justify-center">
                    <div class="badge-neutral w-28 h-10 flex justify-center m-8 items-center rounded-xl">
                        <h1 class="font-semibold">Tidak ada</h1>
                    </div>
                </div>
            @elseif (count($reports) != 0)
                <div class="border border-black rounded-2xl h-auto">
                    @foreach ($reports as $item)
                        <div class="flex justify-between border items-center border-black rounded-2xl m-4 p-4">
                            <div class="flex gap-3">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img
                                            src="{{url($item[1]->image)}}" />
                                    </div>
                                </div>
                                <div class="flex flex-col items-start">
                                    <h1 class="font-semibold">{{$item[1]->name}}</h1>
                                    <h1>{{$item[1]->email}}</h1>
                                </div>
                            </div>
                            <div class="badge badge-warning hidden md:flex ">
                                <h1 class="m-3 font-semibold">{{$item[0]->transaction->total_fund}}</h1>
                            </div>
                        </div>
                    @endforeach
                    <div class="m-4 text-white font-semibold">
                        <a href="/event/report" class="bg-neutral px-3 py-2 rounded-xl">Lihat semua</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

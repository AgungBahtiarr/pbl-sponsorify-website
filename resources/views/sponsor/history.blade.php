@extends('layouts.sponsor_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[30px]">Riwayat</h1>
            <h1 class="font-semibold text-[#7f7f7f]">Lihat acara yang telah kamu terima!</h1>
        </div>
        <div class="">
            <div class="mt-10">
                <div class="border-b border-black mx-12 pb-3 overflow-x-scroll">
                    <ul class="grid grid-cols-5 text-center font-semibold w-[600px] md:w-full items-center">
                        <li>Nama Acara</li>
                        <li>Dana sponsorship</li>
                        <li>Tanggal acara</li>
                        <li>Email penanggung jawab</li>
                        <li class="text-center">Status</li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                @foreach ($histories as $item)
                <div class="mx-10 border border-black rounded-lg my-4 py-3 w-[240px] md:w-[700px] lg:w-[1200px] overflow-x-auto md:overflow-x-hidden">
                <div class="grid grid-cols-5 items-center w-[600px] md:w-full">
                    <h1 class="text-center ">{{$item ->event->name}}</h1>
                    <h1 class="text-center ">{{ $item->total_fund }}</h1>
                    <h1 class="text-center ">{{date('d/m/Y', strtotime($item->event->start_date))}}</h1>
                    <h1 class="text-center ">{{$item ->event->email}}</h1>
                    <div class="flex justify-center lg:pl-6">
                        <span class="badge badge-warning">{{$item->status->status}}</span>
                    </div>
                </div>
            </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

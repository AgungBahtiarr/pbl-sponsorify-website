@extends('layouts.sponsor_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[40px]">Riwayat</h1>
            <h1 class="font-semibold text-[20px] text-[#7f7f7f]">Lihat riwayat yang telah kamu terima</h1>
        </div>
        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-5 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Dana sponsorship</li>
                    <li>Tanggal di terima</li>
                    <li>email penanggung jawab</li>
                    <li>Tindakan</li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col">
        @foreach ($data as $item)
            <div class="grid grid-cols-5 items-center mx-12 border border-black rounded-lg my-4 py-3">
                <h1 class="text-center ">{{$item[1]->event->name}}</h1>
                <h1 class="text-center ">{{$item[0]->transaction->total_fund}}</h1>
                <h1 class="text-center ">{{ date('d/m/Y',strtotime($item[0]->transaction->created_at))}}</h1>
                <h1 class="text-center ">{{$item[1]->event->email}}</h1>
                <div class="flex justify-center">
                    <a href={{$item[0]->report}} class="flex font-medium gap-2 bg-neutral text-white px-10 py-2 rounded-xl">
                        <i class="fa-solid fa-download"></i>
                        Unduh laporan
                    </a>
                </div>
            </div>

        @endforeach
        </div>
    </div>
@endsection

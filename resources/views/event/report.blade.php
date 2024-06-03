@extends('layouts.event_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[40px]">Laporan</h1>
            <h1 class="font-semibold text-[20px] text-[#7f7f7f]">Laporan yang akan anda ajukan</h1>
        </div>

        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-5 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Dana sponsorship</li>
                    <li>Tanggal di terima</li>
                    <li>Nama sponsor</li>
                    <li>Tindakan</li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col">
        @foreach ($data as $event)
             <div class="grid grid-cols-5 text-center items-center mx-12 border border-black rounded-lg my-4 py-3">
                <h1>{{$event->event->name}}</h1>
                <h1>Rp.10,000</h1>
                <h1>{{date('d/m/Y',strtotime($event->created_at))}}</h1>
                <h1>{{$event->sponsor->name}}</h1>
                <div><button class="bg-neutral px-4 py-2 rounded-xl text-white">kirim</button></div>

            </div>

        @endforeach
        </div>
    </div>
@endsection

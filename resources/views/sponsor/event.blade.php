@extends('layouts.sponsor_layout')
@section('content')
    <div class="mx-4 my-10 lg:mx-14">
        <div class="flex flex-col items-center mb-9">
            <h1 class="font-semibold text-[30px] text-center">List proposal masuk</h1>
            <h1 class="text-[#9f9f9f] text-center">Yuk cek beberapa proposal yang sudah masuk di perusahaanmu</h1>
        </div>

        <div class="flex gap-4 flex-col flex-wrap justify-center lg:flex-row ">
                    @foreach ($transactions as $item)
            <div class="rounded-2xl bg-base-100 shadow-xl md:w-96">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="avatar">
                        <div class="w-10 md:w-14 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    </div>
                    <div>
                        <h1 class="font-semibold md:card-title">{{$item->event->name}}</h1>
                        <h1>{{$item->event->email}}</h1>
                    </div>
                </div>
                <h2 class="font-semibold md:card-title mb-[-11px]">Deskripsi</h2>
                <p class="text-justify truncate">{{$item->event->description}}</p>
                <div class="card-actions justify-center">
                    <a class="btn bg-yellow-400 w-full py-2 rounded-lg font-semibold" href="/sponsor/detail/{{$item->id}}">Lihat detail</a>
                </div>
            </div>
        </div>
        @endforeach

        </div>
           </div>
@endsection

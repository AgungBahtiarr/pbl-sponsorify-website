@extends('layouts.sponsor_layout')
@section('content')
    <div class="mx-14 my-10">
        <div class="flex flex-col justify-center items-center mb-3">
            <h1 class="font-semibold text-[40px]">List Proposal Masuk</h1>
            <h1 class="text-[#9f9f9f] text-[20px]">Yuk cek beberapa proposal yang sudah masuk di perusahaanmu</h1>
        </div>

        <div class="flex gap-4">
                    @foreach ($transactions as $item)
            <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="avatar">
                        <div class="w-14 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    </div>
                    <div>
                        <h1 class="card-title">{{$item->event->name}}</h1>
                        <h1>{{$item->event->email}}</h1>
                    </div>
                </div>
                <h2 class="card-title">Deskripsi</h2>
                <p class="text-justify">{{$item->event->description}}</p>
                <div class="card-actions justify-center">
                    <a class="bg-yellow-400 px-28 py-2 rounded-lg" href="/sponsor/detail/{{$item->id}}">Lihat detail</a>
                </div>
            </div>
        </div>
        @endforeach

        </div>
           </div>
@endsection

@extends('layouts.sponsor_layout')
@section('content')
    <div class="mx-14 my-10">
        <div class="flex flex-col justify-center items-center mb-3">
            <h1 class="font-semibold text-[40px]">List Proposal Masuk</h1>
            <h1 class="text-[#9f9f9f] text-[20px]">Yuk cek beberapa proposal yang sudah masuk di perusahaanmu</h1>
        </div>
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="avatar">
                        <div class="w-14 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    </div>
                    <div>
                        <h1 class="card-title">Semarak Kemerdekaan</h1>
                        <h1>kwu@gmail.com</h1>
                    </div>
                </div>
                <h2 class="card-title">Deskripsi</h2>
                <p class="text-justify">Di zaman serba digital ini, kita seolah hidup di dunia yang dipenuhi sihir
                    teknologi. Dari ponsel pintar yang bisa melakukan banyak hal hingga game dan aplikasi yang menghibur ...
                </p>
                <div class="card-actions justify-center">
                    <button class="bg-yellow-400 px-28 py-2 rounded-xl"><a href="/sponsor/detail">Lihat detail</a></button>
                </div>
            </div>
        </div>
    </div>
@endsection

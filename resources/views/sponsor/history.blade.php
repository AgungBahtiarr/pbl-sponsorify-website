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
            <div class="grid grid-cols-5 items-center mx-12 border border-black rounded-lg my-4 py-3">
                <h1 class="text-center ">Nama event</h1>
                <h1 class="text-center ">Rp. 90.000</h1>
                <h1 class="text-center ">12/12/12</h1>
                <h1 class="text-center ">rifqi@gmail.com</h1>
                <div class="flex justify-center">
                    <a class="flex gap-2 bg-neutral text-white px-10 py-2 rounded-xl">
                        <i class="fa-solid fa-download"></i>
                        <h1 class="font-medium">Unduh laporan</h1>
                    </a>
                </div>

            </div>

        </div>
    </div>
@endsection

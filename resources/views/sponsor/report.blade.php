@extends('layouts.sponsor_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[30px]">Laporan</h1>
            <h1 class="font-semibold text-[#7f7f7f]">Lihat laporan yang telah di kirim event organizer!</h1>
        </div>
        <div class="">
            <div class="mt-10">
                <div class="border-b border-black mx-12 pb-3 overflow-x-scroll">
                    <ul class="grid grid-cols-5 text-center font-semibold w-[600px] md:w-full items-center">
                        <li>Nama Acara</li>
                        <li>Dana sponsorship</li>
                        <li>Tanggal di terima</li>
                        <li>email penanggung jawab</li>
                        <li>Tindakan</li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                @foreach ($data as $item)
                    <div class="mx-10 border border-black rounded-lg my-4 py-3 w-[240px] md:w-[700px] lg:w-[1200px] overflow-x-auto md:overflow-x-hidden">
                        <div class="grid grid-cols-5 items-center w-[600px] md:w-full">
                            <h1 class="text-center ">{{ $item[1]->event->name }}</h1>
                            <h1 class="text-center ">{{ $item[0]->transaction->total_fund }}</h1>
                            <h1 class="text-center ">{{ date('d/m/Y', strtotime($item[0]->transaction->created_at)) }}</h1>
                            <h1 class="text-center ">{{ $item[1]->event->email }}</h1>
                            <div class="flex justify-center">
                                <a href={{ $item[0]->report }}
                                    class="btn flex font-medium gap-2 bg-neutral text-white py-2 rounded-xl">
                                    <i class="fa-solid fa-download"></i>
                                    Unduh laporan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

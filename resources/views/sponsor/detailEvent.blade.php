@extends('layouts.sponsor_layout')
@section('content')
    <div class="m-11">
        <div class="flex justify-center gap-14">
            <div class="">
                <img class="w-[352px] h-[352px] rounded-xl drop-shadow-2xl"
                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="">
            </div>
            <div>
                <h1 class="font-semibold text-[50px]">{{$transaction->event->name}}</h1>
                <div class="flex items-center gap-5">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-regular text-4xl fa-calendar"></i>
                    </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">{{ date('d/m/Y', strtotime($transaction->event->start_date)) }} - {{ date('d/m/Y', strtotime($transaction->event->end_date)) }}</h1>
                    </div>
                </div>
                <div class="flex items-center gap-6 mt-3">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-solid text-4xl fa-location-dot"></i>
                    </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">{{$transaction->event->location}}</h1>
                        <h1 class="text-[#8f8f8f]">Kabat Banyuwangi</h1>
                    </div>
                </div>
                <div class="flex items-center gap-5 mt-3">
                   <div class="px-2 py-2 rounded-xl">
                    <i class="fa-regular text-4xl fa-user"></i>
                   </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">{{$event->user->name}}</h1>
                        <h1 class="text-[#8f8f8f]">Penanggung jawab</h1>
                    </div>
                </div>
                <div class="flex justify-start mt-5">
                    <a href="http://localhost:8080/{{$transaction->event->proposal}}" class="flex gap-2 bg-neutral text-white px-40 py-3 rounded-xl">
                        <i class="fa-solid fa-download"></i>
                        <h1 class="font-semibold">Review proposal</h1>
                    </a>
                </div>
            </div>


        </div>
        <div class="mx-40 my-5 flex flex-col items-start">
            <h1 class="font-semibold text-[21px]">Tentang Acara</h1>
            <p class="text-justify">{{$transaction->event->description}}</p>
        </div>
        <div class="flex justify-center gap-5 ">
        <div>
                        <button class="px-52 py-3 bg-green-600 font-semibold text-white rounded-2xl">Terima</button>

        </div>
        <div>
                        <button class="px-52 py-3 bg-red-600 font-semibold text-white rounded-2xl">Tolak</button>

        </div>
        </div>
    </div>
@endsection

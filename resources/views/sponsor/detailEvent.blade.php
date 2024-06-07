@extends('layouts.sponsor_layout')
@section('content')
    <div class="m-11">
        <div class="flex justify-center gap-14">
            <div class="">
                <img class="w-[352px] h-[352px] rounded-xl drop-shadow-2xl"
                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="">
            </div>
            <div>
                <h1 class="font-semibold text-[50px]">Semarak Kemerdekaan</h1>
                <div class="flex items-center gap-5">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-regular text-4xl fa-calendar"></i>
                    </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">Selasa 12/12/12 - Selasa 12/12/12</h1>
                        <h1 class="text-[#8f8f8f]">16.00 WIB</h1>
                    </div>
                </div>
                <div class="flex items-center gap-6 mt-3">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-solid text-4xl fa-location-dot"></i>
                    </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]"> Politeknik Negeri Banyuwangi</h1>
                        <h1 class="text-[#8f8f8f]">Kabat Banyuwangi</h1>
                    </div>
                </div>
                <div class="flex items-center gap-5 mt-3">
                   <div class="px-2 py-2 rounded-xl">
                    <i class="fa-regular text-4xl fa-user"></i>
                   </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">UKM Kewirausahaan</h1>
                        <h1 class="text-[#8f8f8f]">Penanggung jawab</h1>
                    </div>
                </div>
                <div class="flex justify-start mt-5">
                    <button class="flex gap-2 bg-neutral text-white px-40 py-3 rounded-xl">
                        <i class="fa-solid fa-download"></i>
                        <h1 class="font-semibold">Review proposal</h1>
                    </button>
                </div>
            </div>


        </div>
        <div class="mx-40 my-5 flex flex-col items-start">
            <h1 class="font-semibold text-[21px]">Tentang Acara</h1>
            <h1 class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.  </h1>
        </div>
        <div class="flex justify-center gap-5 ">
            <button class="px-52 py-3 bg-green-600 font-semibold text-white rounded-2xl">Terima</button>
            <button class="px-52 py-3 bg-red-600 font-semibold text-white rounded-2xl">Tolak</button>
        </div>
    </div>
@endsection

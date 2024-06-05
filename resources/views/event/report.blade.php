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
                <div class="grid grid-cols-5 items-center mx-12 border border-black rounded-lg my-4 py-3">
                    <h1 class="text-center ">{{ $event->event->name }}</h1>
                    <h1 class="text-center ">Rp. {{ $event->total_fund }}</h1>
                    <h1 class="text-center ">{{ date('d/m/Y', strtotime($event->created_at)) }}</h1>
                    <h1 class="text-center ">{{ $event->sponsor->name }}</h1>
                    <div>
                        <div class="flex justify-center">
                            <button onclick="my_modal_{{$event->id}}.showModal()" class="bg-neutral px-4 py-2 rounded-xl text-white "><i
                                class="fa-solid fa-upload mr-2"></i>kirim laporan</button>
                            <dialog id="my_modal_{{$event->id}}" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg text-center">Kirim laporan</h3>
                                    <p class="py-1 text-center">Kirimkan tautan laporanmu</p>
                                    <form action="/event/report" method="POST">
                                        @csrf

                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                              <span class="label-text font-semibold text-lg">Tautan</span>
                                            </div>
                                            <div class="flex items-center gap-3">
                                            <input type="text" placeholder="tautan laporan" class="input input-bordered w-full max-w-xs" name="report" />
                                          </label>
                                            <input type="hidden" name="id_transaction" value={{$event->id}}>
                                          <div><button class="bg-neutral px-7 py-2 rounded-xl text-white">Kirim</button></div>
                                          </div>

                                    </form>
                                </div>
                            </dialog>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection

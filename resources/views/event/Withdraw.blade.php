@extends('layouts.event_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[30px]">Pencairan</h1>
            <h1 class="font-semibold text-[#7f7f7f]">Segera terima dana sponsormu!</h1>
        </div>
        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-4 text-center font-semibold">
                    <li>Nama Acara</li>
                    <li>Nama Sponsor</li>
                    <li>Dana sponsor</li>
                    <li>Pencairan</li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col">

        @foreach ($data as $item)
            <div class="grid grid-cols-4 items-center mx-12 border border-black rounded-lg my-4 py-3">
                <h1 class="text-center ">{{$item->event->name}}</h1>
                <h1 class="text-center ">{{$item->sponsor->name}}</h1>

                <div class="flex justify-center">
                    @if ($item->id_withdraw_status==1)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-neutral font-semibold text-neutral">
                    Belum di cairkan
                </button>
            </div>
            @elseif ($item->id_withdraw_status==2)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-[#21be32] font-semibold text-[#21be32]">
                    Sedang di proses
                </button>
            </div>
            @elseif ($item->id_withdraw_status==3)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-[#2a9c49] font-semibold text-[#2a9c49]">
                    Selesai
                </button>
            </div>
            @elseif ($item->id_withdraw_status==4)
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-[#db3227] font-semibold text-[#db3227]">
                    Gagal
                </button>
            </div>
            @endif
                </div>


                <div class="flex justify-center">
                    <button class="flex font-semibold gap-2 bg-neutral text-white px-5 py-2 rounded-xl items-center"
                        onclick="my_modalwd_{{$item->id}}.showModal()"><i class="fa-solid fa-hand-holding-dollar"></i><span>Kirim</span></button>
                    <dialog id="my_modalwd_{{$item->id}}" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="id" value={{$item->id}}>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text font-semibold text-lg">Nama bank</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="bank_name" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text font-semibold text-lg">Nama pemilik bank</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="account_name" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text font-semibold text-lg">Nomer rekening</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="no_rek" />
                                </label>
                                <button
                                    class="flex font-semibold gap-2 bg-neutral text-white px-5 py-2 rounded-xl items-center mt-6">
                                    Kirim</button>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>


        @endforeach

        </div>
    </div>
@endsection

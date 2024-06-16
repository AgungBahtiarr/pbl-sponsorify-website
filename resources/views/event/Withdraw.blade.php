@extends('layouts.event_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[40px]">Pencairan</h1>
            <h1 class="font-semibold text-[20px] text-[#7f7f7f]">Segera terima dana sponsormu!</h1>
        </div>
        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-4 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Nama Sponsor</li>
                    <li>Dana sponsor</li>
                    <li>Pencairan</li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="grid grid-cols-4 items-center mx-12 border border-black rounded-lg my-4 py-3">
                <h1 class="text-center ">hm</h1>
                <h1 class="text-center ">hm</h1>

                <div class="flex justify-center">
                    <button href=""
                        class="px-7 py-1 bg-white border rounded-2xl border-[#fbbf0f] font-semibold text-[#fbbf0f]">
                        Proses verifikasi
                    </button>
                </div>


                <div class="flex justify-center">
                    <button class="flex font-semibold gap-2 bg-neutral text-white px-5 py-2 rounded-xl items-center"
                        onclick="my_modal_3.showModal()"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                    <dialog id="my_modal_3" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <form action="">
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text font-semibold text-lg">Nama bank</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text font-semibold text-lg">Nama pemilik bank</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text font-semibold text-lg">Nomer rekening</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="" />
                                </label>
                                <button
                                    class="flex font-semibold gap-2 bg-neutral text-white px-5 py-2 rounded-xl items-center mt-6">
                                    Kirim</button>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>


        </div>
    </div>
@endsection

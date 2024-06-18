@extends('layouts.admin_layout')
@section('content')
<div class="my-11">
    <div class="ml-12">
        <h1 class="font-semibold text-[40px]">Pembayaran</h1>
        <h1 class="font-semibold text-[20px] text-[#7f7f7f]">Apakah admin sudah menerima dana sponsorship?</h1>
    </div>
    <div class="mt-10">
        <div class="border-b border-black mx-12 pb-3">
            <ul class="grid grid-cols-5 text-center font-semibold">
                <li>Nama Event</li>
                <li>Dana sponsorship</li>
                <li>Tanggal pembayaran</li>
                <li>Status</li>
                <li>Tindakan</li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="grid grid-cols-5 items-center mx-12 border border-black rounded-lg my-4 py-3">
            <h1 class="text-center ">Beyonf</h1>
            <h1 class="text-center ">20000</h1>
            <h1 class="text-center">12/12/12</h1>
            <div class="flex justify-center">
                <button href="" class="px-7 py-1 bg-white border rounded-2xl border-neutral font-semibold text-neutral">
                    Belum di cairkan
                </button>
            </div>


            <div class="flex justify-center">
            <button class="btn btn-primary" onclick="my_modal_.showModal()"><i class="fa-regular fa-circle-check"></i></button>
            <dialog id="my_modal_" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="font-bold text-lg">Konfirmasi pembayaran</h3>
                    <form class="mt-4 flex gap-3">
                        <button class="btn btn-success text-white">Sudah</button>
                        <button class="btn btn-error text-white">Tolak</button>
                    </form>
                </div>
            </dialog>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin_layout')
@section('content')
<div class="my-11">
    <div class="ml-12">
        <h1 class="font-semibold text-[30px]">Pencairan</h1>
        <h1 class="font-semibold text-[#7f7f7f]">Segera cairkan dana event yang menunggu</h1>
    </div>
    <div class="mt-10">
        <div class="border-b border-black mx-12 pb-3">
            <ul class="grid grid-cols-8 text-center font-semibold">
                <li>Nama Event</li>
                <li>Nama Bank</li>
                <li>Nama Account</li>
                <li>No Rekening</li>
                <li>Dana sponsorship</li>
                <li>Tanggal penarikan</li>
                <li>Status</li>
                <li>Tindakan</li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col">
        @foreach ($datas as $item)
        <div class="grid grid-cols-8 items-center mx-12 border border-black rounded-lg my-4 py-3">
            <h1 class="text-center ">{{$item->event->name}}</h1>
            <h1 class="text-center ">{{$item->bank_name}}</h1>
            <h1 class="text-center ">{{$item->account_name}}</h1>
            <h1 class="text-center ">{{$item->no_rek}}</h1>
            <h1 class="text-center ">{{$item->total_fund}}</h1>
            <h1 class="text-center">{{date('d/m/Y',strtotime($item->updated_at))}}</h1>
            <div class="flex justify-center">
                <div class="badge badge-neutral">{{$item->withdraw->status}}</div>
            </div>

            <div class="flex justify-center">
            <button class="btn btn-primary" onclick="my_modal_{{$item->id}}.showModal()"><i class="fa-regular fa-circle-check"></i></button>
            <dialog id="my_modal_{{$item->id}}" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="font-bold text-lg">Konfirmasi pembayaran</h3>
                    <div class="flex gap-2">
                        <form method="POST" action="/admin/withdraw" class="mt-4 flex gap-3">
                            @csrf
                            <input type="hidden" name="id" value={{$item->id}}>
                            <input type="hidden" name="id_withdraw_status" value="3">
                            <button class="btn btn-success text-white">Sudah</button>
                        </form>
                        <form method="POST" action="/admin/withdraw" class="mt-4 flex gap-3">
                            @csrf
                            <input type="hidden" name="id" value={{$item->id}}>
                            <input type="hidden" name="id_withdraw_status" value="4">
                            <button class="btn btn-error text-white">Tolak</button>
                        </form>
                    </div>
                </div>
            </dialog>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

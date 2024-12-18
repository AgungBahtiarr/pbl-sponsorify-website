@extends('layouts.admin_layout')
@section('content')
    <div class="my-6 sm:my-11">
        <div class="px-4 sm:ml-12">
            <h1 class="text-2xl sm:text-[30px] font-semibold">Pencairan</h1>
            <h1 class="text-sm sm:text-base font-semibold text-[#7f7f7f]">Segera cairkan dana event yang menunggu</h1>
        </div>

        <!-- Table Header - Hidden on Mobile -->
        <div class="hidden sm:block mt-10">
            <div class="border-b border-black mx-4 sm:mx-12 pb-3">
                <ul class="grid grid-cols-8 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Dana sponsorship</li>
                    <li>Nama Bank</li>
                    <li>Nama Account</li>
                    <li>No Rekening</li>
                    <li>Tanggal penarikan</li>
                    <li>Status</li>
                    <li>Tindakan</li>
                </ul>
            </div>
        </div>

        <!-- Data Cards -->
        <div class="flex flex-col px-4 sm:px-12">
            @foreach ($datas as $item)
                <!-- Mobile Card -->
                <div class="block sm:hidden border border-black rounded-lg my-4 p-4">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-semibold">Nama Event:</span>
                            <span>{{ $item->event->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Dana:</span>
                            <span>Rp. {{ $item->level->fund }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Bank:</span>
                            <span>{{ $item->bank_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Nama Account:</span>
                            <span>{{ $item->account_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">No Rekening:</span>
                            <span>{{ $item->no_rek }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Tanggal:</span>
                            <span>{{ date('d/m/Y', strtotime($item->updated_at)) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Status:</span>
                            <div class="badge badge-neutral">{{ $item->withdraw->status }}</div>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button class="btn btn-primary w-full" onclick="my_modal_{{ $item->id }}.showModal()">
                                <i class="fa-regular fa-circle-check mr-2"></i>Konfirmasi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop Row -->
                <div class="hidden sm:grid grid-cols-8 items-center border border-black rounded-lg my-4 py-3">
                    <h1 class="text-center">{{ $item->event->name }}</h1>
                    <h1 class="text-center">Rp. {{ $item->level->fund }}</h1>
                    <h1 class="text-center">{{ $item->bank_name }}</h1>
                    <h1 class="text-center">{{ $item->account_name }}</h1>
                    <h1 class="text-center">{{ $item->no_rek }}</h1>
                    <h1 class="text-center">{{ date('d/m/Y', strtotime($item->updated_at)) }}</h1>
                    <div class="flex justify-center">
                        <div class="badge badge-neutral">{{ $item->withdraw->status }}</div>
                    </div>
                    <div class="flex justify-center">
                        <button class="btn btn-primary" onclick="my_modal_{{ $item->id }}.showModal()">
                            <i class="fa-regular fa-circle-check mr-2"></i>Konfirmasi
                        </button>
                    </div>
                </div>

                <!-- Modal (Shared between mobile and desktop) -->
                <dialog id="my_modal_{{ $item->id }}" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                        <h3 class="font-bold text-lg">Konfirmasi pembayaran</h3>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <form method="POST" action="/admin/withdraw" class="mt-4">
                                @csrf
                                <input type="hidden" name="id" value={{ $item->id }}>
                                <input type="hidden" name="id_withdraw_status" value="3">
                                <button class="btn btn-success text-white w-full sm:w-auto">Sudah</button>
                            </form>
                            <form method="POST" action="/admin/withdraw" class="mt-4">
                                @csrf
                                <input type="hidden" name="id" value={{ $item->id }}>
                                <input type="hidden" name="id_withdraw_status" value="4">
                                <button class="btn btn-error text-white w-full sm:w-auto">Tolak</button>
                            </form>
                        </div>
                    </div>
                </dialog>
            @endforeach
        </div>
    </div>
@endsection

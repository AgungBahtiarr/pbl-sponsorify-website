@extends('layouts.event_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-[30px] font-semibold mb-2">Pencairan</h1>
            <p class="text-[#7f7f7f] font-semibold">Segera terima dana sponsormu!</p>
        </div>

        <!-- Table Header - Hidden on Mobile -->
        <div class="hidden sm:block border-b border-black pb-3 mb-4">
            <div class="grid grid-cols-5 text-center font-semibold">
                <div>Nama Acara</div>
                <div>Nama Sponsor</div>
                <div>Level Benefit</div>
                <div>Dana sponsor</div>
                <div>Pencairan</div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="space-y-4">
            @foreach ($data as $item)
                <!-- Mobile View -->
                <div class="sm:hidden bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="space-y-3">
                        <div>
                            <span class="font-semibold block mb-1">Nama Acara:</span>
                            <span>{{ $item->event->name }}</span>
                        </div>
                        <div>
                            <span class="font-semibold block mb-1">Nama Sponsor:</span>
                            <span>{{ $item->sponsor->name }}</span>
                        </div>
                        <div>
                            <span class="font-semibold block mb-1">Level Benefit:</span>
                            <span>{{ $item->level->level }}</span>
                        </div>
                        <div>
                            <span class="font-semibold block mb-1">Status:</span>
                            <div class="flex justify-center">
                                @if ($item->id_withdraw_status == 1)
                                    <span class="px-4 py-1 rounded-full border bg-white border-neutral text-neutral">
                                        Belum dicairkan
                                    </span>
                                @elseif ($item->id_withdraw_status == 2)
                                    <span class="px-4 py-1 rounded-full border bg-white border-[#21be32] text-[#21be32]">
                                        Sedang diproses
                                    </span>
                                @elseif ($item->id_withdraw_status == 3)
                                    <span class="px-4 py-1 rounded-full border bg-white border-[#2a9c49] text-[#2a9c49]">
                                        Selesai
                                    </span>
                                @elseif ($item->id_withdraw_status == 4)
                                    <span class="px-4 py-1 rounded-full border bg-white border-[#db3227] text-[#db3227]">
                                        Gagal
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pt-2">
                            <button class="btn btn-neutral w-full gap-2"
                                onclick="my_modalwd_{{ $item->id }}.showModal()">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                <span>Kirim</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop View -->
                <div class="hidden sm:grid grid-cols-5 items-center border border-gray-200 rounded-lg p-4">
                    <div class="text-center truncate px-2">{{ $item->event->name }}</div>
                    <div class="text-center truncate px-2">{{ $item->sponsor->name }}</div>
                    <div class="text-center">{{ $item->level->level }}</div>
                    <div class="flex justify-center">
                        @if ($item->id_withdraw_status == 1)
                            <span class="px-4 py-1 rounded-full border bg-white border-neutral text-neutral">
                                Belum dicairkan
                            </span>
                        @elseif ($item->id_withdraw_status == 2)
                            <span class="px-4 py-1 rounded-full border bg-white border-[#21be32] text-[#21be32]">
                                Sedang diproses
                            </span>
                        @elseif ($item->id_withdraw_status == 3)
                            <span class="px-4 py-1 rounded-full border bg-white border-[#2a9c49] text-[#2a9c49]">
                                Selesai
                            </span>
                        @elseif ($item->id_withdraw_status == 4)
                            <span class="px-4 py-1 rounded-full border bg-white border-[#db3227] text-[#db3227]">
                                Gagal
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-center">
                        <button class="btn btn-neutral gap-2" onclick="my_modalwd_{{ $item->id }}.showModal()">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                            <span>Kirim</span>
                        </button>
                    </div>
                </div>

                <!-- Withdrawal Modal -->
                <dialog id="my_modalwd_{{ $item->id }}" class="modal">
                    <div class="modal-box w-11/12 max-w-md">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>

                        <form action="" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Nama bank</span>
                                </label>
                                <input type="text" placeholder="Masukkan nama bank" class="input input-bordered w-full"
                                    name="bank_name" required />
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Nama pemilik bank</span>
                                </label>
                                <input type="text" placeholder="Masukkan nama pemilik rekening"
                                    class="input input-bordered w-full" name="account_name" required />
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Nomor rekening</span>
                                </label>
                                <input type="text" placeholder="Masukkan nomor rekening"
                                    class="input input-bordered w-full" name="no_rek" required />
                            </div>

                            <button type="submit" class="btn btn-neutral w-full">
                                Kirim
                            </button>
                        </form>
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.sponsor_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[30px]">Pembayaran</h1>
            <h1 class="font-semibold text-[#7f7f7f]">Segera lakukan sponsorshipmu!</h1>
        </div>
        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-4 text-center font-semibold">
                    <li>Nama Acara</li>
                    <li>Status</li>
                    <li>Tindakan</li>
                </ul>
            </div>
        </div>
        @foreach ($data as $item)
            <div class="flex flex-col">
                <div class="grid grid-cols-4 items-center mx-12 border border-black rounded-lg my-4 py-3">
                    <h1 class="text-center ">{{ $item->event->name }}</h1>
                    @if ($item->id_payment_status == 1)
                        <div class="flex justify-center">
                            <button href=""
                                class="px-7 py-1 bg-white border rounded-2xl border-neutral font-semibold text-neutral">
                                Belum di cairkan
                            </button>
                        </div>
                    @elseif ($item->id_payment_status == 2)
                        <div class="flex justify-center">
                            <button href=""
                                class="px-7 py-1 bg-white border rounded-2xl border-[#21be32] font-semibold text-[#21be32]">
                                Sedang di proses
                            </button>
                        </div>
                    @elseif ($item->id_payment_status == 3)
                        <div class="flex justify-center">
                            <button href=""
                                class="px-7 py-1 bg-white border rounded-2xl border-[#2a9c49] font-semibold text-[#2a9c49]">
                                Selesai
                            </button>
                        </div>
                    @elseif ($item->id_payment_status == 4)
                        <div class="flex justify-center">
                            <button href=""
                                class="px-7 py-1 bg-white border rounded-2xl border-[#db3227] font-semibold text-[#db3227]">
                                Gagal
                            </button>
                        </div>
                    @endif

                    <div class="flex justify-center">
                        <button class="btn btn-primary" onclick="my_modal_{{ $item->id }}.showModal()">Bayar</button>
                        <dialog id="my_modal_{{ $item->id }}" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="font-semibold text-lg">Silahkan lakukan pembayaran sebesar</h3>
                                <h3 class="font-bold text-lg">Rp. {{ $item->level->fund }}</h3>
                                <form action="/sponsor/payNow" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value={{ $item->id }} />
                                    <button class="btn btn-primary my-4">Bayar sekarang</button>
                                </form>
                            </div>
                        </dialog>
                    </div>
                </div>
        @endforeach
    </div>
    </div>
@endsection

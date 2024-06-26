@extends('layouts.event_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[30px]">Status</h1>
            <h1 class="font-semibold text-[#7f7f7f]">Status Pengajuan Proposal yang telah anda ajukan</h1>
        </div>

        <div class="mt-10">
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-4 text-center font-semibold">
                    <li>Nama Event</li>
                    <li>Tanggal Pengajuan</li>
                    <li>Nama Sponsor</li>
                    <li>Status</li>
                </ul>
            </div>

            <div class="flex flex-col">
                @foreach ($transactions as $transaction)
                    <div class="grid grid-cols-4 text-center items-center mx-12 border border-black rounded-lg my-4 py-3">

                        <div class="">
                            <h1>{{ $transaction->event->name }}</h1>
                        </div>

                        <h1>{{ date('d/m/Y', strtotime($transaction->created_at)) }}</h1>
                        <h1>{{ $transaction->sponsor->name }}</h1>
                        <div>
                            @if ($transaction->id_status == 1)
                                <div>
                                    <button onclick="my_modal_proses_{{ $transaction->id }}.showModal()"
                                        class="px-7 py-1 bg-neutral rounded-2xl font-semibold text-white">cek
                                        status</button>
                                    <dialog id="my_modal_proses_{{ $transaction->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="font-bold text-lg mb-4">Status</h3>
                                            <button
                                                class="px-7 py-2 rounded-lg bg-yellow-400 font-semibold">{{ $transaction->status->status }}</button>
                                            <div class="flex justify-start mb-2 ml-1">
                                                <span class="font-semibold">Pesan :</span>
                                            </div>
                                            <div class="border-2 rounded-2xl w-full h-32">
                                                <p>Proposal kamu sedang dalam review pihak sponsor</p>
                                            </div>

                                        </div>
                                    </dialog>
                                </div>
                            @elseif ($transaction->id_status == 2)
                            <div>
                                <button onclick="my_modal_proses_{{ $transaction->id }}.showModal()"
                                    class="px-7 py-1 rounded-2xl bg-neutral font-semibold text-white">cek
                                    status</button>
                                <dialog id="my_modal_proses_{{ $transaction->id }}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <h3 class="font-bold text-lg mb-4">Status</h3>
                                        <span
                                            class="px-7 py-2 rounded-lg bg-[#30a24f] font-semibold text-white">{{ $transaction->status->status }}</span>
                                        <div class="flex justify-start mb-2 ml-1">
                                            <span class="font-semibold">Pesan :</span>
                                        </div>
                                        <div class="border-2 rounded-2xl w-full h-32">
                                            <p>{{ $transaction->comment }}</p>
                                        </div>

                                    </div>
                                </dialog>
                            </div>
                            @elseif ($transaction->id_status == 3)
                            <div class="modal-box">
                                <form method="dialog">
                                    <button
                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="font-bold text-lg mb-4">Status</h3>
                                <button
                                    class="px-7 py-2 rounded-lg bg-[#de362a] font-semibold text-black">{{ $transaction->status->status }}</button>
                                <div class="flex justify-start mb-2 ml-1">
                                    <span class="font-semibold">Pesan :</span>
                                </div>
                                <div class="border-2 rounded-2xl w-full h-32">
                                    <p>{{ $transaction->comment }}</p>
                                </div>

                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>


        </div>


    </div>
@endsection

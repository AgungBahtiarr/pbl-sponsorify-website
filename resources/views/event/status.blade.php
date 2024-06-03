@extends('layouts.event_layout')
@section('content')
    <div class="my-11">
        <div class="ml-12">
            <h1 class="font-semibold text-[40px]">Status</h1>
            <h1 class="font-semibold text-[20px] text-[#7f7f7f]">Status Pengajuan Proposal yang telah anda ajukan</h1>
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

                        <h1>{{date('d/m/Y', strtotime($transaction->created_at))}}</h1>
                        <h1>{{$transaction->sponsor->name}}</h1>
                        <div>
                            @if ($transaction->id_status == 1)
                                <button
                                    class="px-7 py-1 bg-white border rounded-2xl border-[#ffcd1d] font-semibold text-[#ffcd1d]">{{ $transaction->status->status }}</button>
                            @elseif ($transaction->id_status == 2)
                                <button
                                    class="px-7 py-1 bg-white border rounded-2xl border-[#21be32] font-semibold text-[#21be32]">{{ $transaction->status->status }}</button>
                            @elseif ($transaction->id_status == 3)
                                <button
                                    class="px-7 py-1 bg-white border rounded-2xl border-[#ff0000] font-semibold text-[#ff0000]">{{ $transaction->status->status }}</button>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>


        </div>


    </div>
@endsection

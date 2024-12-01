@extends('layouts.event_layout')
@section('content')
    <div class="flex flex-col m-3 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="w-full sm:w-auto">
                <div class="flex flex-col gap-3 md:flex-row md:items-center">
                    <h1 class="font-semibold text-2xl sm:text-3xl lg:text-[35px] break-words">{{ $sponsor->name }}</h1>
                    <div class="badge badge-neutral h-7 whitespace-nowrap">{{ $sponsor->category->category }}</div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 font-medium text-base sm:text-lg mt-2">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot"></i>
                        <p class="break-words">{{ $sponsor->address }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>{{ $sponsor->max_submission_date }}</p>
                    </div>
                </div>
            </div>
            <button class="btn btn-neutral w-full sm:w-auto">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-share-nodes"></i>
                    <span>Bagikan</span>
                </div>
            </button>
        </div>

        <div class="flex justify-center my-6">
            <div class="avatar w-full max-w-4xl">
                <div class="w-full aspect-video rounded overflow-hidden">
                    <img src="http://127.0.0.1:8080/{{ $sponsor->image }}" 
                         class="w-full h-full object-cover"
                         alt="{{ $sponsor->name }}" />
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="font-bold text-xl sm:text-2xl">Deskripsi</h2>
            <p class="text-base sm:text-lg whitespace-pre-wrap">
                {{ $sponsor->description }}
            </p>
        </div>

        <button class="btn btn-neutral mt-6 w-full sm:w-auto" onclick="my_modal_3.showModal()">
            Kirim proposal
        </button>

        <dialog id="my_modal_3" class="modal">
            <div class="modal-box w-11/12 max-w-md">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <form action="/event/sponsor/detail" method="POST" class="space-y-4">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Pilih proposal acara yang akan kamu ajukan!</span>
                        </label>
                        <select name="id_event" class="select select-bordered w-full">
                            <option disabled selected>Pilih salah satu</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="id_sponsor" value="{{ $sponsor->id }}">
                    <button class="btn btn-neutral w-full">Kirim</button>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
@endsection
@extends('layouts.event_layout')
@section('content')
<div class=" flex flex-col m-3">
    <div class="flex justify-between items-center mx-9">
        <div>
            <div class="flex flex-col justify-start gap-3 md:flex-row md:items-center">
                <p class="font-semibold text-[35px]">{{$sponsor->name}}</p>
                <div class="badge badge-neutral truncate  ... h-7">{{$sponsor->category->category}}</div>
            </div>
            <div class="flex flex-row gap-3 font-medium text-[18px]">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{$sponsor->address}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar-days"></i>
                    <p>{{$sponsor->max_submission_date}}</p>
                </div>
            </div>
        </div>
        <label for="" class="btn btn-neutral">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-share-nodes"></i>
                <h1>bagikan</h1>
            </div>
        </label>
    </div>
    <div class="flex justify-center">
        <!-- <figure class="w-screen ">
                <img class="h-[400px] object-cover w-[93%] rounded-md mx-10 my-6" src="http://127.0.0.1:8080/{{$sponsor->image}}"
                    alt="">
            </figure> -->
        <div class="avatar">
            <div class="h-[400px] my-6 rounded">
                <img src="http://127.0.0.1:8080/{{$sponsor->image}}" />
            </div>
        </div>
    </div>
    <div class="mx-9">
        <p class="font-bold text-[25px]">Deskripsi</p>
        <p>
            {{$sponsor->description}}
        </p>
    </div>

    <button class="btn btn-neutral mt-4 mx-9" onclick="my_modal_3.showModal()">Kirim proposal</button>
    <dialog id="my_modal_3" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Pilih proposal acara yang akan kamu ajukan!</span>

                </div>
                <form action="/event/sponsor/detail" method="POST">
                    @csrf
                    <select name="id_event" class="select select-bordered">
                        <option disabled selected>Pilih salah satu</option>
                        @foreach ($events as $event)
                        <option value={{$event->id}}>{{ $event->name }}</option>
                        @endforeach
                    </select>
            </label>
            <input type="hidden" name="id_sponsor" value={{$sponsor->id}}>
            <button class="btn btn-active btn-neutral mt-4 mx-3">Kirim</button>
            </form>
        </div>
    </dialog>
</div>
@endsection

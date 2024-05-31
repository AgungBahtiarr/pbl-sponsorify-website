@extends('layouts.event_layout')
@section('content')
    <div class="m-3 mt-20">
        <div class="flex flex-col items-center mb-14">
            <h1 class="font-bold text-[30px] text-neutral">Pencarian sponsor</h1>
            <h1 class="text-neutral">Temukan sponsor impianmu disini!</h1>
        </div>
        <div>
            <form action="/sponsor/search" method="POST">
                @csrf
                <div class="flex justify-center">

                    <label class="input input-bordered flex items-center gap-2 w-1/2">

                        <input type="text" class="grow" name="str" placeholder="Search" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </label>


                </div>
            </form>
        </div>

        <div class="flex justify-start mt-11 mb-[76px] gap-2 overflow-auto md:justify-center">
            @foreach ($categories as $category)
                <form action="/sponsor/categories" method="post">
                    @csrf
                    <input type="hidden" name="id_category" value={{ $category->id }}>
                    <button class="btn btn-outline hover:bg-neutral">{{ $category->category }}</button>
                </form>
            @endforeach

        </div>
        <div class="flex justify-center items-center gap-2 overflow-scroll flex-col md:flex-row">
            @foreach ($data as $sponsor)
                <div class="card w-72 bg-base-100 shadow-xl md:w-96 ">
                    <figure><img src="http://127.0.0.1:8000/{{ $sponsor->image }}" alt="{{$sponsor->name}}" /></figure>
                    <div class="card-body">
                        <div class="flex flex-col gap-2 md:flex-row">
                            <h2 class="card-title">
                                {{ $sponsor->name }}
                            </h2>
                            <div class="">
                                <div class="badge badge-neutral truncate  ... h-8">{{ $sponsor->category->category }}</div>

                            </div>
                        </div>
                        <p class="h-24 text-ellipsis overflow-hidden ... text-pretty">{{ $sponsor->description }}</p>
                        <div class="card-actions justify-center">
                            <div class="rounded-lg bg-neutral text-white w-96 h-10 flex justify-center items-center">
                                <a href="/event/sponsor/detail/{{$sponsor->id}}">Lihat detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>


    </div>
@endsection

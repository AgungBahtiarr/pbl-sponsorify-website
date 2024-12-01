@extends('layouts.event_layout')
@section('content')
    <div class="m-3 mt-20">
        <div class="flex flex-col items-center mb-14">
            <h1 class="font-bold text-[30px] text-neutral text-center">Pencarian sponsor</h1>
            <h1 class="font-semibold text-[#7f7f7f] text-center">Temukan sponsor impianmu disini!</h1>
        </div>

        <div>
            <form action="/sponsor/search" method="POST">
                @csrf
                <div class="flex justify-center px-4">
                    <label class="input input-bordered flex items-center gap-2 w-full md:w-1/2">
                        <input type="text" class="grow" name="str" placeholder="Cari ..." />
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

        <div class="flex justify-start mt-11 mb-[76px] gap-2 overflow-x-auto px-4 md:justify-center">
            @foreach ($categories as $category)
                <form action="/sponsor/categories" method="post">
                    @csrf
                    <input type="hidden" name="id_category" value={{ $category->id }}>
                    <button class="btn btn-outline hover:bg-neutral whitespace-nowrap">{{ $category->category }}</button>
                </form>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4">
            @foreach ($data as $sponsor)
                <div class="card bg-base-100 shadow-xl my-6 w-full max-w-sm mx-auto">
                    <div class="flex justify-center">
                        <div class="avatar">
                            <div class="w-full rounded-xl">
                                <img src="/{{ $sponsor->image }}" alt="{{ $sponsor->name }}" class="w-full object-cover" />
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="flex flex-col gap-2 sm:flex-row items-start sm:items-center">
                            <h2 class="card-title text-lg">
                                {{ $sponsor->name }}
                            </h2>
                            <div class="badge badge-neutral truncate h-8">
                                {{ $sponsor->category->category }}
                            </div>
                        </div>
                        <p class="h-24 text-ellipsis overflow-hidden text-sm">{{ $sponsor->description }}</p>
                        <div class="card-actions justify-center mt-4">
                            <a href="/event/sponsor/detail/{{ $sponsor->id }}" class="btn btn-neutral text-white w-full">
                                Lihat detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

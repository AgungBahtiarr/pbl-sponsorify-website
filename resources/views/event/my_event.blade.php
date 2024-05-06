@extends('layouts.event_layout')
@section('content')
    @if (count($events) == 0)
        <div class="flex justify-center items-center h-[89vh]">
            <div class="flex flex-col items-center gap-3">
                <h1 class="text-xl font-semibold">Silahkan tambahkan event terlebih dahulu</h1>
                <div>
                    <button class="btn btn-primary font-semibold" onclick="noEvent.showModal()">Tambah Event</button>
                    <dialog id="noEvent" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg">Tambah Event</h3>
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Event name</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="name" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Description</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="description" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Location</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="location" />
                                </label>

                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Start date</span>
                                    </div>
                                    <input type="date" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="start_date" />
                                </label>

                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Proposal</span>
                                    </div>
                                    <input type="file" placeholder="Type here"
                                        class="file-input file-input-bordered w-full max-w-xs" name="proposal" />
                                </label>
                                <div class="flex justify-end">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>
        </div>
    @else
        <div>
            <div class="flex justify-center my-14">
                <h1 class="text-2xl font-bold">Your Events</h1>
            </div>
            <div class="overflow-x-auto mb-10 mx-6">
                <table class="table border ">
                    <!-- head -->
                    <thead>
                        <tr class="text-black">
                            <th class="font-bold text-[18px]">Name</th>
                            <th class="font-bold text-[18px]">Description</th>
                            <th class="font-bold text-[18px]">Location</th>
                            <th class="font-bold text-[18px]">Proposal</th>
                            <th class="font-bold text-[18px]">Start date</th>
                            <th>                <div>
                                <button class="btn btn-primary font-semibold" onclick="noEvent.showModal()">Tambah Event</button>
                                <dialog id="noEvent" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <h3 class="font-bold text-lg">Tambah Event</h3>
                                        <form method="post" enctype="multipart/form-data">
                                            @csrf
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Event name</span>
                                                </div>
                                                <input type="text" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" name="name" />
                                            </label>
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Description</span>
                                                </div>
                                                <input type="text" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" name="description" />
                                            </label>
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Location</span>
                                                </div>
                                                <input type="text" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" name="location" />
                                            </label>

                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Start date</span>
                                                </div>
                                                <input type="date" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" name="start_date" />
                                            </label>

                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Proposal</span>
                                                </div>
                                                <input type="file" placeholder="Type here"
                                                    class="file-input file-input-bordered w-full max-w-xs" name="proposal" />
                                            </label>
                                            <div class="flex justify-end">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>
                            </div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $item)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <div class="font-bold">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>{{ $item->location }}</td>
                                <th>
                                    <a href={{"http://localhost:8000/" .  $item->proposal }}>Download</a>
                                </th>
                                <td>
                                    {{ $item->start_date }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

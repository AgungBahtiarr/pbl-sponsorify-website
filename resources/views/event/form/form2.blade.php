@extends('layouts.event_layout')
@section('content')
<div class="flex justify-center mb-5">
    <h1 class="font-semibold text-[30px]">Tambah event</h1>
</div>
    <div class="flex justify-center mb-8">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                <div>
                    <h1 class="font-semibold">Platinum</h1>
                    <input type="hidden" name="id_event">
                    <input type="hidden" name="level1">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Total pendanaan /slot</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="fund1" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">slot sponsor</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="slot1" />
                </label>
                </div>
                <div>
                    <h1 class="font-semibold">Gold</h1>
                    <input type="hidden" name="id_event">
                    <input type="hidden" name="level2">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Total pendanaan /slot</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="fund2" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">slot sponsor</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="slot2" />
                </label>
                </div>
                <div>
                    <h1 class="font-semibold">Silver</h1>
                    <input type="hidden" name="id_event">
                    <input type="hidden" name="level3">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Total pendanaan /slot</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="fund3" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">slot sponsor</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="slot3" />
                </label>
                </div>
                <div>
                    <h1 class="font-semibold">Bronze</h1>
                    <input type="hidden" name="id_event">
                    <input type="hidden" name="level4">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Total pendanaan /slot</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="fund4" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">slot sponsor</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="slot4" />
                </label>
                </div>
            </div>

            <div class="flex justify-start mt-4">
                <button class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.sponsor_layout')
@section('content')
    <div class="m-11">
        <div class="mx-40 flex justify-center gap-14">
            <div class="avatar">
                <div class="w-[400px] rounded-xl">
                    <img class=" rounded-xl drop-shadow-2xl" src="http://localhost:8080/{{ $transaction->event->image }}"
                        alt="">
                </div>
            </div>
            <!-- <div class="h-[552px] flex justify-center items-center">
                                                                                                                                                                                                                                <img class=" rounded-xl drop-shadow-2xl" src="http://localhost:8080/{{ $transaction->event->image }}" alt="">
                                                                                                                                                                                                                            </div> -->
            <div>
                <h1 class="font-semibold text-[50px]">{{ $transaction->event->name }}</h1>
                <div class="flex items-center gap-5">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-regular text-4xl fa-calendar"></i>
                    </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">
                            {{ date('d/m/Y', strtotime($transaction->event->start_date)) }} -
                            {{-- {{ date('d/m/Y', strtotime($transaction->event->end_date)) }} --}}
                        </h1>
                        <h1 class="text-[#8f8f8f]">Tanggal Mulai</h1>
                    </div>
                </div>
                <div class="flex items-center gap-6 mt-3">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-solid text-4xl fa-location-dot"></i>
                    </div>
                    <div class="">
                        <a href="{{ $transaction->event->location }}" target="_blank"
                            class="text-blue-500 font-semibold underline">Lihat
                            Alamat</a>

                        <h1 class="text-[#8f8f8f]">Alamat
                            Acara</h1>
                    </div>
                </div>
                <div class="flex items-center gap-5 mt-3">
                    <div class="px-2 py-2 rounded-xl">
                        <i class="fa-regular text-4xl fa-user"></i>
                    </div>
                    <div class="">
                        <h1 class="font-semibold text-[20px]">{{ $event->user->name }}</h1>
                        <h1 class="text-[#8f8f8f]">Penanggung jawab</h1>
                    </div>
                </div>
                <div class="flex justify-start mt-5">
                    <a href="http://localhost:8080/{{ $transaction->event->proposal }}"
                        class="flex gap-2 bg-neutral text-white px-40 py-3 rounded-xl">
                        <i class="fa-solid fa-download"></i>
                        <h1 class="font-semibold">Review proposal</h1>
                    </a>
                </div>
            </div>


        </div>

        <div class="mx-40 my-5 flex flex-col items-start">
            <h1 class="font-semibold text-[21px]">Tentang Acara</h1>
            <p class="text-justify">{{ $transaction->event->description }}</p>
        </div>
        <div class="flex justify-center gap-5">
            <div>
                <button class="px-52 py-3 bg-green-500 font-semibold text-white rounded-2xl" onclick="my_modal_terima.showModal()">Terima</button>
                <dialog id="my_modal_terima" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            {{-- <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" type="button" onclick="resetTerimForm()">✕</button> --}}
                            <h3 class="font-bold text-lg mt-5 mb-4">Kirim pesan untuk Event organizer</h3>
                        </form>
                        <div>
                            <form id="formTerima" action="/sponsor/review" method="post" onsubmit="return validateTerimForm(event)">
                                @csrf
                                @method('patch')
                                <label class="flex items-center gap-2 mb-2">
                                    <select name="id_level" id="levelSelect" class="grow select select-bordered" required>
                                        <option value="">Pilih Benefit</option>
                                        @foreach ($levels as $level)
                                            @if ($level->slot !== 0)
                                                <option value="{{ $level->id }}" data-fund="{{ str_replace(',', '', $level->fund) }}">
                                                    {{ $level->level }} - Rp. {{ $level->fund }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </label>
                                <div id="benefitError" class="text-red-500 text-sm mb-2 hidden">Benefit belum dipilih</div>

                                <input type="hidden" name="total_fund" id="totalFund" class="grow" />

                                <label class="input input-bordered flex items-center gap-2 mt-2">
                                    <input type="text" class="grow" name="comment" id="commentTerima"
                                        placeholder="Masukan pesan untuk event organizer" />
                                </label>
                                <div id="commentTerimError" class="text-red-500 text-sm mb-2 hidden"></div>

                                <input type="hidden" name="id_status" value="2">
                                <input type="hidden" name="id" value={{ $transaction->id }}>

                                <div class="flex gap-2 mt-5">
                                    <button type="submit" class="px-10 py-2 rounded-2xl text-white bg-neutral font-semibold">Kirim</button>
                                    <button type="button" onclick="cancelTerimForm()" class="px-10 py-2 rounded-2xl text-white bg-gray-500 font-semibold">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>

            <div>
                <button class="px-52 py-3 bg-red-600 font-semibold text-white rounded-2xl" onclick="my_modal_tolak.showModal()">Tolak</button>
                <dialog id="my_modal_tolak" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            {{-- <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" type="button" onclick="resetTolakForm()">✕</button> --}}
                            <h3 class="font-bold text-lg mt-5 mb-4">Kirim alasan untuk Event organizer</h3>
                        </form>
                        <div>
                            <form id="formTolak" action="/sponsor/review" method="post" onsubmit="return validateTolakForm(event)">
                                @csrf
                                @method('patch')
                                <label class="input input-bordered flex items-center gap-2">
                                    <input type="text" name="comment" id="commentTolak" class="grow"
                                        placeholder="Masukan umpan balik untuk event organizer" />
                                </label>
                                <div id="commentTolakError" class="text-red-500 text-sm mb-2 hidden"></div>

                                <input type="hidden" name="id_status" value="3">
                                <input type="hidden" name="id" value={{ $transaction->id }}>

                                <div class="flex gap-2 mt-5">
                                    <button type="submit" class="px-10 py-2 rounded-2xl text-white bg-neutral font-semibold">Kirim</button>
                                    <button type="button" onclick="cancelTolakForm()" class="px-10 py-2 rounded-2xl text-white bg-gray-500 font-semibold">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('levelSelect');
            const totalFund = document.getElementById('totalFund');

            if (select && select.options.length > 0) {
                totalFund.value = select.options[select.selectedIndex].getAttribute('data-fund');
            }

            select.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                totalFund.value = selectedOption.getAttribute('data-fund');
            });
        });

        function validateTerimForm(event) {
            event.preventDefault();
            let isValid = true;

            // Validate benefit
            const benefit = document.getElementById('levelSelect').value;
            const benefitError = document.getElementById('benefitError');
            if (!benefit) {
                benefitError.textContent = 'Benefit belum dipilih';
                benefitError.classList.remove('hidden');
                isValid = false;
            } else {
                benefitError.classList.add('hidden');
            }

            // Validate comment
            const comment = document.getElementById('commentTerima').value;
            const commentError = document.getElementById('commentTerimError');

            if (comment.length < 15) {
                commentError.textContent = 'Teks pesan kurang dari 15 karakter';
                commentError.classList.remove('hidden');
                isValid = false;
            } else if (comment.length > 255) {
                commentError.textContent = 'Teks pesan lebih dari 255 karakter';
                commentError.classList.remove('hidden');
                isValid = false;
            } else {
                commentError.classList.add('hidden');
            }

            if (isValid) {
                document.getElementById('formTerima').submit();
            }
            return false;
        }

        function validateTolakForm(event) {
            event.preventDefault();
            let isValid = true;

            const comment = document.getElementById('commentTolak').value;
            const commentError = document.getElementById('commentTolakError');

            if (comment.length < 15) {
                commentError.textContent = 'Teks pesan kurang dari 15 karakter';
                commentError.classList.remove('hidden');
                isValid = false;
            } else if (comment.length > 255) {
                commentError.textContent = 'Teks pesan lebih dari 255 karakter';
                commentError.classList.remove('hidden');
                isValid = false;
            } else {
                commentError.classList.add('hidden');
            }

            if (isValid) {
                document.getElementById('formTolak').submit();
            }
            return false;
        }

        function resetTerimForm() {
            document.getElementById('formTerima').reset();
            document.getElementById('commentTerimError').classList.add('hidden');
            document.getElementById('benefitError').classList.add('hidden');
        }

        function resetTolakForm() {
            document.getElementById('formTolak').reset();
            document.getElementById('commentTolakError').classList.add('hidden');
        }

        function cancelTerimForm() {
            resetTerimForm();
            my_modal_terima.close();
        }

        function cancelTolakForm() {
            resetTolakForm();
            my_modal_tolak.close();
        }
        </script>
@endsection

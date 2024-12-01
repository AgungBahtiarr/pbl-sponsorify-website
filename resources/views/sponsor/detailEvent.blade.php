@extends('layouts.sponsor_layout')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto">
            <!-- Event Details Section -->
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-14 mb-12">
                <!-- Image Section -->
                <div class="w-full lg:w-1/2">
                    <div class="rounded-xl overflow-hidden shadow-2xl">
                        <img src="/{{ $transaction->event->image }}" alt="{{ $transaction->event->name }}"
                            class="w-full h-auto object-cover">
                    </div>
                </div>

                <!-- Event Info Section -->
                <div class="w-full lg:w-1/2 space-y-6">
                    <h1 class="text-3xl sm:text-4xl lg:text-[50px] font-semibold leading-tight">
                        {{ $transaction->event->name }}
                    </h1>

                    <!-- Date Info -->
                    <div class="flex items-center gap-4">
                        <div class="text-3xl sm:text-4xl text-gray-600">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-lg sm:text-xl">
                                {{ date('d/m/Y', strtotime($transaction->event->start_date)) }}
                            </h2>
                            <p class="text-gray-500">Tanggal Mulai</p>
                        </div>
                    </div>

                    <!-- Location Info -->
                    <div class="flex items-center gap-4">
                        <div class="text-3xl sm:text-4xl text-gray-600">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <a href="{{ $transaction->event->location }}" target="_blank"
                                class="text-blue-500 font-semibold underline hover:text-blue-600">
                                Lihat Alamat
                            </a>
                            <p class="text-gray-500">Alamat Acara</p>
                        </div>
                    </div>

                    <!-- PIC Info -->
                    <div class="flex items-center gap-4">
                        <div class="text-3xl sm:text-4xl text-gray-600">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-lg sm:text-xl">{{ $event->user->name }}</h2>
                            <p class="text-gray-500">Penanggung jawab</p>
                        </div>
                    </div>

                    <!-- Proposal Button -->
                    <div class="pt-4">
                        <a href="/{{ $transaction->event->proposal }}"
                            class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3 bg-neutral text-white rounded-xl hover:bg-neutral-700 transition-colors">
                            <i class="fa-solid fa-download"></i>
                            <span class="font-semibold">Review proposal</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- About Event Section -->
            <div class="mb-12">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4">Tentang Acara</h2>
                <p class="text-gray-700 text-justify">{{ $transaction->event->description }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-3xl mx-auto">
                <button onclick="my_modal_terima.showModal()"
                    class="w-full py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-colors">
                    Terima
                </button>
                <button onclick="my_modal_tolak.showModal()"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-colors">
                    Tolak
                </button>
            </div>

            <!-- Accept Modal -->
            <dialog id="my_modal_terima" class="modal">
                <div class="modal-box w-11/12 max-w-md">
                    <h3 class="font-bold text-lg mb-6">Kirim pesan untuk Event organizer</h3>

                    <form id="formTerima" action="/sponsor/review" method="post" onsubmit="return validateTerimForm(event)"
                        class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <select name="id_level" id="levelSelect" class="select select-bordered w-full" required>
                                <option value="">Pilih Benefit</option>
                                @foreach ($levels as $level)
                                    @if ($level->slot !== 0)
                                        <option value="{{ $level->id }}"
                                            data-fund="{{ str_replace(',', '', $level->fund) }}">
                                            {{ $level->level }} - Rp. {{ $level->fund }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div id="benefitError" class="text-red-500 text-sm mt-1 hidden"></div>
                        </div>

                        <input type="hidden" name="total_fund" id="totalFund">

                        <div>
                            <input type="text" name="comment" id="commentTerima" class="input input-bordered w-full"
                                placeholder="Masukan pesan untuk event organizer">
                            <div id="commentTerimError" class="text-red-500 text-sm mt-1 hidden"></div>
                        </div>

                        <input type="hidden" name="id_status" value="2">
                        <input type="hidden" name="id" value="{{ $transaction->id }}">

                        <div class="flex gap-2 pt-2">
                            <button type="submit" class="flex-1 btn btn-neutral">Kirim</button>
                            <button type="button" onclick="cancelTerimForm()" class="flex-1 btn btn-ghost">Batal</button>
                        </div>
                    </form>
                </div>
            </dialog>

            <!-- Reject Modal -->
            <dialog id="my_modal_tolak" class="modal">
                <div class="modal-box w-11/12 max-w-md">
                    <h3 class="font-bold text-lg mb-6">Kirim alasan untuk Event organizer</h3>

                    <form id="formTolak" action="/sponsor/review" method="post" onsubmit="return validateTolakForm(event)"
                        class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <input type="text" name="comment" id="commentTolak" class="input input-bordered w-full"
                                placeholder="Masukan umpan balik untuk event organizer">
                            <div id="commentTolakError" class="text-red-500 text-sm mt-1 hidden"></div>
                        </div>

                        <input type="hidden" name="id_status" value="3">
                        <input type="hidden" name="id" value="{{ $transaction->id }}">

                        <div class="flex gap-2 pt-2">
                            <button type="submit" class="flex-1 btn btn-neutral">Kirim</button>
                            <button type="button" onclick="cancelTolakForm()"
                                class="flex-1 btn btn-ghost">Batal</button>
                        </div>
                    </form>
                </div>
            </dialog>
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

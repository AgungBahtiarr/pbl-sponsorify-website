@extends('layouts.event_layout')
@section('content')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>

    <div class="min-h-[90vh] flex flex-col justify-center px-4 py-8">
        <div class="max-w-6xl mx-auto w-full">
            <h1 class="text-2xl sm:text-3xl font-semibold text-center mb-6 sm:mb-10">
                Detail Sponsor Benefit
            </h1>

            @error('message')
                <div class="max-w-lg mx-auto mb-6">
                    <div role="alert" class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: {{ $errors->first() }}</span>
                    </div>
                </div>
            @enderror

            <form method="post" enctype="multipart/form-data" id="benefitForm" class="w-full">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <!-- Platinum -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="font-semibold text-xl mb-4">Platinum</h2>
                        <input type="hidden" name="id_event">
                        <input type="hidden" name="level1" value="platinum">

                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </label>
                                <input type="text" placeholder="Rp 10.000.000"
                                    class="input input-bordered w-full rupiah-input" name="fund1"
                                    oninput="formatRupiah(this)" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </label>
                                <input type="number" placeholder="Jumlah slot (contoh: 2)"
                                    class="input input-bordered w-full" name="slot1" min="1" />
                            </div>
                        </div>
                    </div>

                    <!-- Gold -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="font-semibold text-xl mb-4">Gold</h2>
                        <input type="hidden" name="level2" value="gold">

                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </label>
                                <input type="text" placeholder="Rp 7.500.000"
                                    class="input input-bordered w-full rupiah-input" name="fund2"
                                    oninput="formatRupiah(this)" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </label>
                                <input type="number" placeholder="Jumlah slot (contoh: 3)"
                                    class="input input-bordered w-full" name="slot2" min="1" />
                            </div>
                        </div>
                    </div>

                    <!-- Silver -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="font-semibold text-xl mb-4">Silver</h2>
                        <input type="hidden" name="level3" value="silver">

                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </label>
                                <input type="text" placeholder="Rp 5.000.000"
                                    class="input input-bordered w-full rupiah-input" name="fund3"
                                    oninput="formatRupiah(this)" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </label>
                                <input type="number" placeholder="Jumlah slot (contoh: 4)"
                                    class="input input-bordered w-full" name="slot3" min="1" />
                            </div>
                        </div>
                    </div>

                    <!-- Bronze -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="font-semibold text-xl mb-4">Bronze</h2>
                        <input type="hidden" name="level4" value="bronze">

                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </label>
                                <input type="text" placeholder="Rp 2.500.000"
                                    class="input input-bordered w-full rupiah-input" name="fund4"
                                    oninput="formatRupiah(this)" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </label>
                                <input type="number" placeholder="Jumlah slot (contoh: 5)"
                                    class="input input-bordered w-full" name="slot4" min="1" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                    <a href="/event/formSatu" class="btn btn-secondary w-full sm:w-auto">Kembali</a>
                    <button type="submit" class="btn btn-primary w-full sm:w-auto">Simpan & Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^\d]/g, '');

            if (value !== '') {
                value = parseInt(value).toLocaleString('id-ID');
                input.value = 'Rp ' + value;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('benefitForm');
            const rupiahInputs = document.querySelectorAll('.rupiah-input');

            rupiahInputs.forEach(input => {
                if (input.value !== '') {
                    formatRupiah(input);
                }
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                rupiahInputs.forEach(input => {
                    input.value = input.value.replace(/[Rp\s.]/g, '');
                });

                this.submit();
            });
        });
    </script>
@endsection

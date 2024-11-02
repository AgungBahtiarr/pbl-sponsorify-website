@extends('layouts.event_layout')
@section('content')
    <style>
        /* Menghilangkan tombol panah pada input number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>




    <div class="h-[90vh] flex flex-col justify-center">
        <div class="flex justify-center mb-5 md:mb-10">
            <h1 class="font-semibold text-[30px]">Detail Sponsor Benefit</h1>
        </div>
        @error('message')
            <div class="flex justify-center">
                <div role="alert" class="alert alert-error mb-5 max-w-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: {{ $errors->first() }}</span>
                </div>
            </div>
        @enderror

        <div class="flex justify-center mb-8">
            <form method="post" enctype="multipart/form-data" id="benefitForm">
                @csrf
                <div class="flex flex-col md:gap-4 mx-12">

                    <div class="flex gap-4">
                        <div>
                            <h1 class="font-semibold">Platinum</h1>
                            <input type="hidden" name="id_event">
                            <input type="hidden" name="level1" value="platinum">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </div>
                                <input type="text" placeholder="Rp 10.000.000"
                                    class="input input-bordered w-full max-w-xs rupiah-input" name="fund1"
                                    oninput="formatRupiah(this)" />
                            </label>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </div>
                                <input type="number" placeholder="Jumlah slot (contoh: 2)"
                                    class="input input-bordered w-full max-w-xs" name="slot1" min="1" />
                            </label>
                        </div>

                        <div>
                            <h1 class="font-semibold">Gold</h1>
                            <input type="hidden" name="id_event">
                            <input type="hidden" name="level2" value="gold">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </div>
                                <input type="text" placeholder="Rp 7.500.000"
                                    class="input input-bordered w-full max-w-xs rupiah-input" name="fund2"
                                    oninput="formatRupiah(this)" />
                            </label>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </div>
                                <input type="number" placeholder="Jumlah slot (contoh: 3)"
                                    class="input input-bordered w-full max-w-xs" name="slot2" min="1" />
                            </label>
                        </div>
                    </div>


                    <div class="flex gap-4">
                        <div>
                            <h1 class="font-semibold">Silver</h1>
                            <input type="hidden" name="id_event">
                            <input type="hidden" name="level3" value="silver">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </div>
                                <input type="text" placeholder="Rp 5.000.000"
                                    class="input input-bordered w-full max-w-xs rupiah-input" name="fund3"
                                    oninput="formatRupiah(this)" />
                            </label>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </div>
                                <input type="number" placeholder="Jumlah slot (contoh: 4)"
                                    class="input input-bordered w-full max-w-xs" name="slot3" min="1" />
                            </label>
                        </div>

                        <div>
                            <h1 class="font-semibold">Bronze</h1>
                            <input type="hidden" name="id_event">
                            <input type="hidden" name="level4" value="bronze">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Total pendanaan /slot</span>
                                </div>
                                <input type="text" placeholder="Rp 2.500.000"
                                    class="input input-bordered w-full max-w-xs rupiah-input" name="fund4"
                                    oninput="formatRupiah(this)" />
                            </label>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Slot sponsor</span>
                                </div>
                                <input type="number" placeholder="Jumlah slot (contoh: 5)"
                                    class="input input-bordered w-full max-w-xs" name="slot4" min="1" />
                            </label>
                        </div>
                    </div>
                </div>


                <div class="flex justify-between mt-4 mx-12">
                    <a href="/event/formSatu" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
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

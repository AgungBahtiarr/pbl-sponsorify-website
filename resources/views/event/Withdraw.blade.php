@extends('layouts.event_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-[30px] font-semibold mb-2">Pencairan</h1>
            <p class="text-[#7f7f7f] font-semibold">Segera terima dana sponsormu!</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error mb-4">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Table Header - Hidden on Mobile -->
        <div class="hidden sm:block border-b border-black pb-3 mb-4">
            <div class="grid grid-cols-5 text-center font-semibold">
                <div>Nama Acara</div>
                <div>Nama Sponsor</div>
                <div>Level Benefit</div>
                <div>Dana sponsor</div>
                <div>Pencairan</div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="space-y-4">
            @foreach ($data as $item)
                <!-- ... mobile view tetap sama ... -->

                <!-- Desktop View -->
                <div class="hidden sm:grid grid-cols-5 items-center border border-gray-200 rounded-lg p-4">
                    <div class="text-center truncate px-2">{{ $item->event->name }}</div>
                    <div class="text-center truncate px-2">{{ $item->sponsor->name }}</div>
                    <div class="text-center">{{ $item->level->level }}</div>
                    <div class="flex justify-center">
                        @if ($item->id_withdraw_status == 1)
                            <span class="px-4 py-1 rounded-full border bg-white border-neutral text-neutral">
                                Belum dicairkan
                            </span>
                        @elseif ($item->id_withdraw_status == 2)
                            <span class="px-4 py-1 rounded-full border bg-white border-[#21be32] text-[#21be32]">
                                Sedang diproses
                            </span>
                        @elseif ($item->id_withdraw_status == 3)
                            <span class="px-4 py-1 rounded-full border bg-white border-[#2a9c49] text-[#2a9c49]">
                                Selesai
                            </span>
                        @elseif ($item->id_withdraw_status == 4)
                            <span class="px-4 py-1 rounded-full border bg-white border-[#db3227] text-[#db3227]">
                                Gagal
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-center">
                        <button class="btn btn-neutral gap-2" onclick="my_modalwd_{{ $item->id }}.showModal()">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                            <span>Kirim</span>
                        </button>
                    </div>
                </div>

                <!-- Withdrawal Modal -->
                <dialog id="my_modalwd_{{ $item->id }}" class="modal">
                    <div class="modal-box w-11/12 max-w-md">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>

                        <form action="/api/withdraw" method="POST" class="space-y-4" id="withdrawForm_{{ $item->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="id_withdraw_status" value="2">

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Nama bank</span>
                                </label>
                                <select class="select select-bordered w-full" name="bank_name" required>
                                    <option value="">Pilih Bank</option>
                                    <option value="BCA">BCA</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BRI">BRI</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                    <option value="BTN">BTN</option>
                                    <option value="CIMB NIAGA">CIMB NIAGA</option>
                                    <option value="DANAMON">DANAMON</option>
                                    <option value="PERMATA">PERMATA</option>
                                    <option value="OCBC NISP">OCBC NISP</option>
                                    <option value="MAYBANK">MAYBANK</option>
                                    <option value="BANK SYARIAH INDONESIA">BANK SYARIAH INDONESIA</option>
                                    <option value="MEGA">MEGA</option>
                                    <option value="BTPN">BTPN</option>
                                    <option value="SINARMAS">SINARMAS</option>
                                    <option value="BJB">BJB</option>
                                </select>
                                <span class="text-error text-sm hidden" id="bankError_{{ $item->id }}"></span>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Nama pemilik rekening</span>
                                </label>
                                <input type="text" placeholder="Masukkan nama pemilik rekening (3-50 karakter)"
                                    class="input input-bordered w-full" name="account_name" required
                                    minlength="3" maxlength="50"/>
                                <span class="text-error text-sm hidden" id="accountNameError_{{ $item->id }}"></span>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Nomor rekening</span>
                                </label>
                                <input type="text" placeholder="Masukkan nomor rekening (10-15 digit)"
                                    class="input input-bordered w-full" name="no_rek" required
                                    minlength="10" maxlength="15" pattern="\d*"/>
                                <span class="text-error text-sm hidden" id="accountNumberError_{{ $item->id }}"></span>
                            </div>

                            <button type="submit" class="btn btn-neutral w-full">
                                Kirim
                            </button>
                        </form>
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('form[id^="withdrawForm_"]').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Reset error messages
                form.querySelectorAll('.text-error').forEach(error => error.classList.add('hidden'));

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        // Show error message
                        if (result.message.includes('bank')) {
                            document.getElementById('bankError_' + formData.get('id')).textContent = result.message;
                            document.getElementById('bankError_' + formData.get('id')).classList.remove('hidden');
                        } else if (result.message.includes('rekening')) {
                            document.getElementById('accountNumberError_' + formData.get('id')).textContent = result.message;
                            document.getElementById('accountNumberError_' + formData.get('id')).classList.remove('hidden');
                        } else if (result.message.includes('pengguna')) {
                            document.getElementById('accountNameError_' + formData.get('id')).textContent = result.message;
                            document.getElementById('accountNameError_' + formData.get('id')).classList.remove('hidden');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan sistem');
                }
            });
        });
    </script>
@endsection

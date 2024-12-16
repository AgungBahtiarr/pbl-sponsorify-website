@extends('layouts.event_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-[30px] font-semibold mb-2">Laporan</h1>
            <p class="text-[#7f7f7f] font-semibold">Laporan yang akan anda ajukan</p>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- Alert Error --}}
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
                <div>Dana sponsorship</div>
                <div>Tanggal diterima</div>
                <div>Nama sponsor</div>
                <div>Tindakan</div>
            </div>
        </div>

        <!-- Events List -->
        <div class="space-y-4">
            @foreach ($data as $event)
                <!-- Mobile View -->
                <div class="sm:hidden bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="space-y-3">
                        <div>
                            <span class="font-semibold block mb-1">Nama Acara:</span>
                            <span>{{ $event->event->name }}</span>
                        </div>
                        <div>
                            <span class="font-semibold block mb-1">Dana sponsorship:</span>
                            <span>Rp. {{ number_format($event->level->fund, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <span class="font-semibold block mb-1">Tanggal diterima:</span>
                            <span>{{ date('d/m/Y', strtotime($event->created_at)) }}</span>
                        </div>
                        <div>
                            <span class="font-semibold block mb-1">Nama sponsor:</span>
                            <span>{{ $event->sponsor->name }}</span>
                        </div>
                        <div class="pt-2">
                            <button onclick="my_modal_{{ $event->id }}.showModal()"
                                    class="btn btn-neutral w-full gap-2"
                                    {{ isset($event->report) ? 'disabled' : '' }}>
                                <i class="fa-solid fa-upload"></i>
                                <span>{{ isset($event->report) ? 'Laporan terkirim' : 'Kirim laporan' }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop View -->
                <div class="hidden sm:grid grid-cols-5 items-center border border-gray-200 rounded-lg p-4">
                    <div class="text-center truncate px-2">{{ $event->event->name }}</div>
                    <div class="text-center">Rp. {{ number_format($event->level->fund, 0, ',', '.') }}</div>
                    <div class="text-center">{{ date('d/m/Y', strtotime($event->created_at)) }}</div>
                    <div class="text-center truncate px-2">{{ $event->sponsor->name }}</div>
                    <div class="flex justify-center">
                        <button onclick="my_modal_{{ $event->id }}.showModal()"
                                class="btn btn-neutral gap-2"
                                {{ isset($event->report) ? 'disabled' : '' }}>
                            <i class="fa-solid fa-upload"></i>
                            <span>{{ isset($event->report) ? 'Laporan terkirim' : 'Kirim laporan' }}</span>
                        </button>
                    </div>
                </div>

                <!-- Report Modal -->
                <dialog id="my_modal_{{ $event->id }}" class="modal">
                    <div class="modal-box w-11/12 max-w-md">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>

                        <div class="text-center mb-6">
                            <h3 class="font-bold text-lg">Kirim laporan</h3>
                            <p class="text-gray-600">Kirimkan tautan laporanmu</p>
                        </div>

                        <form action="/event/report" method="POST" class="space-y-4" id="reportForm_{{ $event->id }}">
                            @csrf
                            <input type="hidden" name="id_transaction" value="{{ $event->id }}">

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-semibold">Tautan Google Drive</span>
                                </label>
                                <input type="text"
                                       placeholder="https://drive.google.com/file/xxx"
                                       class="input input-bordered w-full @error('report') input-error @enderror"
                                       name="report"
                                       required
                                       pattern="https://drive\.google\.com/.*"
                                       title="Link harus dari Google Drive"
                                       oninvalid="this.setCustomValidity('Link harus dari Google Drive')"
                                       oninput="this.setCustomValidity('')"/>
                                @error('report')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
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
        // Handle form submission
        document.querySelectorAll('form[id^="reportForm_"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const input = this.querySelector('input[name="report"]');

                // Check if empty
                if (!input.value.trim()) {
                    e.preventDefault();
                    alert('Link laporan wajib diisi');
                    return;
                }

                // Check if it's a Google Drive link
                if (!input.value.includes('drive.google.com')) {
                    e.preventDefault();
                    alert('Link harus dari Google Drive');
                    return;
                }
            });
        });
    </script>
@endsection

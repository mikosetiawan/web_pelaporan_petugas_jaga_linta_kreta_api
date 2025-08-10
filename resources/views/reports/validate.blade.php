<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validasi Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Detail Laporan</h3>
                        <p>Petugas: {{ $report->user->name }}</p>
                        <p>Lokasi: {{ $report->crossing->name }}</p>
                        <p>Tanggal: {{ $report->created_at->format('d M Y H:i') }}</p>
                        <p>Jenis: {{ $report->type === 'routine' ? 'Rutin' : 'Insiden' }}</p>
                        <div class="mt-2 p-4 bg-gray-50 rounded">
                            <h4 class="font-medium">Isi Laporan:</h4>
                            <p>{{ $report->content }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('reports.validate', $report) }}">
                        @csrf
                        
                        <div class="mb-4">
                            <x-label for="status" :value="__('Status Validasi')" />
                            <select id="status" name="status" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="validated">Valid</option>
                                <option value="rejected">Tidak Valid</option>
                            </select>
                            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="validation_notes" :value="__('Catatan Validasi')" />
                            <textarea id="validation_notes" name="validation_notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" rows="3" required>{{ old('validation_notes') }}</textarea>
                            @error('validation_notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <x-button>
                            {{ __('Validasi Laporan') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="mb-4 rounded-md bg-green-100 border border-green-400 text-green-700 px-4 py-3" role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error') || $errors->any())
                        <div class="mb-4 rounded-md bg-red-100 border border-red-400 text-red-700 px-4 py-3" role="alert">
                            <strong class="font-bold">Gagal!</strong>
                            <span class="block sm:inline">
                                {{ session('error') ?? 'Periksa kembali input Anda.' }}
                                @if($errors->any())
                                    <ul class="list-disc ml-5">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </span>
                        </div>
                    @endif

                    @if(isset($error))
                        <div class="mb-4 rounded-md bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3" role="alert">
                            <strong class="font-bold">Peringatan!</strong>
                            <span class="block sm:inline">{{ $error }}</span>
                        </div>
                    @elseif($attendance && $crossing)
                        <form method="POST" action="{{ route('reports.store') }}">
                            @csrf

                            <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                            <input type="hidden" name="crossing_id" value="{{ $crossing->id }}">

                            <div class="mb-4">
                                <x-label for="type" :value="__('Jenis Laporan')" />
                                <select id="type" name="type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="routine">Rutin</option>
                                    <option value="incident">Insiden</option>
                                </select>
                                @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <x-label for="content" :value="__('Isi Laporan')" />
                                <textarea id="content" name="content" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" rows="5" required>{{ old('content') }}</textarea>
                                @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div id="incident-details" class="mb-4 hidden">
                                <x-label :value="__('Detail Insiden')" />
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <x-label for="incident_time" :value="__('Waktu Insiden')" />
                                        <x-input id="incident_time" class="block mt-1 w-full" type="time" name="incident_details[time]" value="{{ old('incident_details.time') }}" />
                                        @error('incident_details.time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <x-label for="incident_type" :value="__('Jenis Insiden')" />
                                        <x-input id="incident_type" class="block mt-1 w-full" type="text" name="incident_details[type]" value="{{ old('incident_details.type') }}" />
                                        @error('incident_details.type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-label for="incident_description" :value="__('Deskripsi Lengkap')" />
                                        <textarea id="incident_description" name="incident_details[description]" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" rows="3">{{ old('incident_details.description') }}</textarea>
                                        @error('incident_details.description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <x-label :value="__('Checklist Perlengkapan')" />
                                <div class="mt-2 space-y-2">
                                    @foreach($crossing->equipment as $item)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="equipment_checklist[]" value="{{ $item->id }}" class="form-checkbox" {{ in_array($item->id, old('equipment_checklist', [])) ? 'checked' : '' }}>
                                            <span class="ml-2">{{ $item->name }} ({{ $item->condition }})</span>
                                        </label>
                                    @endforeach
                                    @error('equipment_checklist') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <x-button>
                                {{ __('Simpan Laporan') }}
                            </x-button>
                        </form>

                        <script>
                            document.getElementById('type').addEventListener('change', function () {
                                const incidentDetails = document.getElementById('incident-details');
                                incidentDetails.classList.toggle('hidden', this.value !== 'incident');
                            });
                        </script>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Tidak ada kehadiran hari ini!</strong>
                            <span class="block sm:inline">Anda harus melakukan check-in terlebih dahulu sebelum membuat laporan.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
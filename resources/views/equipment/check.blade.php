<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cek Perlengkapan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($crossing)
                        <h3 class="text-lg font-medium mb-4">Perlengkapan di {{ $crossing->name }}</h3>
                        
                        <form method="POST" action="{{ route('equipment.verify') }}">
                            @csrf
                            
                            <div class="mb-6">
                                @forelse($equipment as $item)
                                    <div class="mb-4 p-4 border rounded">
                                        <h4 class="font-medium">{{ $item->name }}</h4>
                                        <p class="text-sm text-gray-600 mb-2">{{ $item->description ?? 'Tidak ada deskripsi' }}</p>
                                        <p class="text-sm">Jumlah: {{ $item->quantity }}</p>
                                        
                                        <input type="hidden" name="equipment[{{ $loop->index }}][id]" value="{{ $item->id }}">
                                        
                                        <div class="mt-2">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="equipment[{{ $loop->index }}][condition]" value="baik" class="form-radio" required>
                                                <span class="ml-2">Baik</span>
                                            </label>
                                            <label class="inline-flex items-center ml-4">
                                                <input type="radio" name="equipment[{{ $loop->index }}][condition]" value="rusak_ringan" class="form-radio">
                                                <span class="ml-2">Rusak Ringan</span>
                                            </label>
                                            <label class="inline-flex items-center ml-4">
                                                <input type="radio" name="equipment[{{ $loop->index }}][condition]" value="rusak_berat" class="form-radio">
                                                <span class="ml-2">Rusak Berat</span>
                                            </label>
                                            @error("equipment.{$loop->index}.condition")
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-600">Tidak ada perlengkapan untuk diperiksa.</p>
                                @endforelse
                            </div>

                            <div class="mb-4">
                                <x-label for="notes" :value="__('Catatan Tambahan')" />
                                <textarea id="notes" name="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <x-button type="submit">
                                {{ __('Verifikasi Perlengkapan') }}
                            </x-button>
                        </form>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Tidak ada jadwal hari ini!</strong>
                            <span class="block sm:inline">Anda tidak memiliki jadwal penjagaan untuk hari ini.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
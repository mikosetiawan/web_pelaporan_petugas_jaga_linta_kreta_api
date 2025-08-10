<x-app-layout title="Tambah Jadwal Baru">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Jadwal Baru</h2>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('schedules.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Crossing Selection -->
                            <div>
                                <label for="crossing_id" class="block text-sm font-medium text-gray-700">Lintasan</label>
                                <select id="crossing_id" name="crossing_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Pilih Lintasan</option>
                                    @foreach($crossings as $crossing)
                                        <option value="{{ $crossing->id }}" {{ old('crossing_id') == $crossing->id ? 'selected' : '' }}>
                                            {{ $crossing->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('crossing_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- User Selection -->
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Petugas</label>
                                <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Pilih Petugas</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" id="date" name="date" value="{{ old('date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Time Range -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('start_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('end_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Shift Selection -->
                            <div>
                                <label for="shift" class="block text-sm font-medium text-gray-700">Shift</label>
                                <select id="shift" name="shift" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Pilih Shift</option>
                                    <option value="pagi" {{ old('shift') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                    <option value="sore" {{ old('shift') == 'sore' ? 'selected' : '' }}>Sore</option>
                                    <option value="malam" {{ old('shift') == 'malam' ? 'selected' : '' }}>Malam</option>
                                </select>
                                @error('shift')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('schedules.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
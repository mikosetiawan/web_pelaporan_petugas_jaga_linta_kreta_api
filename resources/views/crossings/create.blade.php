<x-app-layout title="Tambah Perlintasan Baru">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Perlintasan Baru</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('crossings.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="code" class="block text-gray-700 text-sm font-bold mb-2">Kode Perlintasan*</label>
                        <input type="text" name="code" id="code" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('code')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Perlintasan*</label>
                        <input type="text" name="name" id="name" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Lokasi*</label>
                        <input type="text" name="location" id="location" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('location')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status*</label>
                        <select name="status" id="status" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="latitude" class="block text-gray-700 text-sm font-bold mb-2">Latitude</label>
                        <input type="number" step="any" name="latitude" id="latitude"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('latitude')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="longitude" class="block text-gray-700 text-sm font-bold mb-2">Longitude</label>
                        <input type="number" step="any" name="longitude" id="longitude"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('longitude')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex items-center justify-between mt-6">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                    <a href="{{ route('crossings.index') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<x-app-layout title="Tambah Pengguna Baru">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Pengguna Baru</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap*</label>
                        <input type="text" name="name" id="name" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email*</label>
                        <input type="email" name="email" id="email" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password*</label>
                        <input type="password" name="password" id="password" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password*</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    
                    <div>
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role*</label>
                        <select name="role" id="role" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="korlap">Korlap</option>
                            <option value="petugas">Petugas</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('phone')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                        <textarea name="address" id="address" rows="3"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        @error('address')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex items-center justify-between mt-6">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                    <a href="{{ route('users.index') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
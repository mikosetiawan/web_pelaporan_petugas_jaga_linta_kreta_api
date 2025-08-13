<x-app-layout title="Detail Perlintasan">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Perlintasan</h1>
            <div class="flex space-x-2">
                <a href="{{ route('crossings.edit', $crossing->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md flex items-center space-x-2 transition duration-200">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
                <a href="{{ route('crossings.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md flex items-center space-x-2 transition duration-200">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Dasar</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Perlintasan</p>
                            <p class="text-gray-800">{{ $crossing->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Perlintasan</p>
                            <p class="text-gray-800">{{ $crossing->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="text-gray-800">{{ $crossing->location }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="text-gray-800">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $crossing->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($crossing->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Tambahan</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Koordinat</p>
                            <p class="text-gray-800">
                                @if($crossing->latitude && $crossing->longitude)
                                    {{ $crossing->latitude }}, {{ $crossing->longitude }}
                                @else
                                    Tidak tersedia
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Deskripsi</p>
                            <p class="text-gray-800">{{ $crossing->description ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dibuat Pada</p>
                            <p class="text-gray-800">{{ $crossing->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Diperbarui Pada</p>
                            <p class="text-gray-800">{{ $crossing->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Jadwal Terkait</h2>
                @if($crossing->schedules->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($crossing->schedules as $schedule)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $schedule->date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $schedule->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ ucfirst($schedule->shift) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Belum ada jadwal untuk perlintasan ini.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
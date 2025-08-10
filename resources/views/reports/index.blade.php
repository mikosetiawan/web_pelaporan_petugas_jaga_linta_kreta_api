<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Laporan Saya</h3>
                        <a href="{{ route('reports.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Buat Laporan Baru
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 rounded-md bg-green-100 border border-green-400 text-green-700 px-4 py-3" role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 rounded-md bg-red-100 border border-red-400 text-red-700 px-4 py-3" role="alert">
                            <strong class="font-bold">Gagal!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($reports->isEmpty())
                        <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Belum ada laporan!</strong>
                            <span class="block sm:inline">Anda belum membuat laporan apapun.</span>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($reports as $report)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $report->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $report->crossing?->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $report->type === 'routine' ? 'Rutin' : 'Insiden' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $report->status === 'validated' ? 'bg-green-100 text-green-800' : 
                                                       ($report->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                                       ($report->status === 'submitted' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                                    {{ $report->status === 'validated' ? 'Tervalidasi' : 
                                                       ($report->status === 'rejected' ? 'Ditolak' : 
                                                       ($report->status === 'submitted' ? 'Menunggu Validasi' : 'Draf')) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('reports.show', $report->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                                @if($report->status === 'draft')
                                                    <a href="{{ route('reports.edit', $report->id) }}" class="ml-4 text-green-600 hover:text-green-900">Edit</a>
                                                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                    </form>
                                                @endif
                                                @if($report->status === 'submitted' && (auth()->user()->role === 'korlap' || auth()->user()->role === 'admin'))
                                                    <a href="{{ route('reports.validate', $report->id) }}" class="ml-4 text-purple-600 hover:text-purple-900">Validasi</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
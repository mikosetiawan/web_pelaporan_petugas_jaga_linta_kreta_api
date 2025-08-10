<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Laporan') }}
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

                    @if(session('error'))
                        <div class="mb-4 rounded-md bg-red-100 border border-red-400 text-red-700 px-4 py-3" role="alert">
                            <strong class="font-bold">Gagal!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-medium mb-4">Informasi Laporan</h3>
                            <p><strong>Tanggal:</strong> {{ $report->created_at->format('d M Y') }}</p>
                            <p><strong>Lokasi:</strong> {{ $report->crossing?->name ?? 'N/A' }}</p>
                            <p><strong>Jenis:</strong> {{ $report->type === 'routine' ? 'Rutin' : 'Insiden' }}</p>
                            <p><strong>Status:</strong>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $report->status === 'validated' ? 'bg-green-100 text-green-800' : 
                                       ($report->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                       ($report->status === 'submitted' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ $report->status === 'validated' ? 'Tervalidasi' : 
                                       ($report->status === 'rejected' ? 'Ditolak' : 
                                       ($report->status === 'submitted' ? 'Menunggu Validasi' : 'Draf')) }}
                                </span>
                            </p>
                            <p><strong>Isi Laporan:</strong> {{ $report->content }}</p>
                        </div>

                        @if($report->type === 'incident' && !empty($report->incident_details))
                            <div>
                                <h3 class="text-lg font-medium mb-4">Detail Insiden</h3>
                                <p><strong>Waktu:</strong> {{ $report->incident_details['time'] ?? 'N/A' }}</p>
                                <p><strong>Jenis Insiden:</strong> {{ $report->incident_details['type'] ?? 'N/A' }}</p>
                                <p><strong>Deskripsi:</strong> {{ $report->incident_details['description'] ?? 'N/A' }}</p>
                            </div>
                        @endif

                        @if(!empty($report->equipment_checklist))
                            <div>
                                <h3 class="text-lg font-medium mb-4">Checklist Perlengkapan</h3>
                                <ul class="list-disc ml-5">
                                    @foreach($report->equipment_checklist as $equipmentId)
                                        @php
                                            $equipment = \App\Models\Equipment::find($equipmentId);
                                        @endphp
                                        <li>{{ $equipment?->name ?? 'N/A' }} ({{ $equipment?->condition ?? 'N/A' }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($report->status !== 'draft' && $report->validation_notes)
                            <div>
                                <h3 class="text-lg font-medium mb-4">Catatan Validasi</h3>
                                <p><strong>Validator:</strong> {{ $report->validator?->name ?? 'N/A' }}</p>
                                <p><strong>Tanggal Validasi:</strong> {{ $report->validated_at?->format('d M Y H:i') ?? 'N/A' }}</p>
                                <p><strong>Catatan:</strong> {{ $report->validation_notes }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('reports.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        @if($report->status === 'draft')
                            <a href="{{ route('reports.edit', $report->id) }}"
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Edit
                            </a>
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline-block ml-2"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
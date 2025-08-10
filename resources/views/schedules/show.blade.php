<x-app-layout title="Detail Jadwal">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Detail Jadwal</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Crossing -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Lintasan</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-900">{{ $schedule->crossing->name }}</p>
                            </div>
                        </div>

                        <!-- User -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Petugas</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-900">{{ $schedule->user->name }}</p>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Tanggal</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-900">{{ $schedule->date->format('d M Y') }}</p>
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Jam</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-900">{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                            </div>
                        </div>

                        <!-- Shift -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Shift</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-900">{{ ucfirst($schedule->shift) }}</p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Status</p>
                            </div>
                            <div class="md:col-span-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $schedule->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($schedule->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('schedules.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kembali
                        </a>
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
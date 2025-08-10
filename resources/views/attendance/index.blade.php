<x-app-layout title="Absensi Petugas Jaga">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($todaySchedule)
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-800">Jadwal Hari Ini</h3>
                            <div class="mt-2 space-y-1 text-gray-700">
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Lokasi: {{ $todaySchedule->crossing->name }}</span>
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Shift: {{ ucfirst($todaySchedule->shift) }} ({{ $todaySchedule->start_time }} - {{ $todaySchedule->end_time }})</span>
                                </p>
                            </div>
                        </div>

                        @if (!$attendance)
                            <form action="{{ route('attendance.checkIn') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="schedule_id" value="{{ $todaySchedule->id }}">

                                <div>
                                    <label for="check_in_location" class="block text-sm font-medium text-gray-700">Lokasi Check-in</label>
                                    <input id="check_in_location" name="check_in_location" type="text" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <textarea id="notes" name="notes" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Check-in
                                    </button>
                                </div>
                            </form>
                        @elseif($attendance->status === 'checked_in')
                            <form method="POST" action="{{ route('attendance.checkOut') }}" class="space-y-4">
                                @csrf
                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">

                                <div>
                                    <label for="check_out_location" class="block text-sm font-medium text-gray-700">Lokasi Check-out</label>
                                    <input id="check_out_location" name="check_out_location" type="text" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <textarea id="notes" name="notes" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $attendance->notes }}</textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Check-out
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="rounded-md bg-green-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-green-800">Absensi hari ini sudah lengkap!</h3>
                                        <div class="mt-2 text-sm text-green-700">
                                            <p>Check-in: {{ $attendance->check_in }}</p>
                                            <p>Check-out: {{ $attendance->check_out }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="rounded-md bg-yellow-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Tidak ada jadwal hari ini!</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Anda tidak memiliki jadwal penjagaan untuk hari ini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
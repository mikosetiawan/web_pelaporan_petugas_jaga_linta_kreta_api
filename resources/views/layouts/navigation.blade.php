<!-- Navigation Menu -->
<nav class="bg-white shadow-md border-b">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            <div class="flex space-x-8">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-3 py-2 font-medium
    {{ request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }}">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                    </svg>
                    Dashboard
                </a>

                @if(auth()->user()->role === 'admin')
                        <!-- Kelola Jadwal -->
                        <a href="{{ route('schedules.index') }}"
                            class="flex items-center px-3 py-2
                    {{ request()->routeIs('schedules.*') ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }}">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" />
                            </svg>
                            Kelola Jadwal
                        </a>
                @endif

                <!-- Data Petugas -->
                <a href="{{ route('attendance.index') }}"
                    class="flex items-center px-3 py-2
    {{ request()->routeIs('attendance.*') ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }}">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Absensi Petugas
                </a>

                <!-- Riwayat Laporan -->
                <a href="{{ route('reports.index') }}"
                    class="flex items-center px-3 py-2
    {{ request()->routeIs('reports.*') ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }}">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Pelaporan
                </a>

                <!-- Kelola Lokasi -->
                <a href="{{ route('equipment.check') }}"
                    class="flex items-center px-3 py-2 {{ request()->routeIs('equipment.*') ? 'text-blue-600 border-b-2 border-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }}">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 16 16" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path fill="#444" d="M7.3 14.2l-7.1-5.2 1.7-2.4 4.8 3.5 6.6-8.5 2.3 1.8z"></path>
                    </svg>
                    Check Perlengkapan
                </a>


                <!-- Monitoring Real-time (Belum Ada Route, Bisa Kosongkan / Tambahkan Nanti) -->
                {{-- <a href="#"
                    class="flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-600 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z" />
                    </svg>
                    Monitoring Real-time
                </a> --}}
            </div>
        </div>
    </div>
</nav>
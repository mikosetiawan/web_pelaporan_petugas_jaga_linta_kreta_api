@props(['title' => null])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | Pelaporan Petugas Jaga Lintasan KA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#374151'
                    }
                }
            }
        }
    </script>
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        /* Override default DataTables styles with Tailwind */
        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5em;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.375rem;
            padding-left: 0.5rem;
            padding-right: 2rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin-left: 0.25rem;
            margin-right: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    @include('layouts.header')

    @include('layouts.navigation')

    <div class="container mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Petugas Aktif</p>
                        <p class="text-3xl font-bold text-green-600">24</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Laporan Hari Ini</p>
                        <p class="text-3xl font-bold text-blue-600">18</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Laporan Pending</p>
                        <p class="text-3xl font-bold text-yellow-600">3</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Insiden Bulan Ini</p>
                        <p class="text-3xl font-bold text-red-600">2</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Crumbs Navigation --}}
        <nav class="flex px-5 py-3 text-gray-700 bg-gray-100 rounded-lg" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 20a1 1 0 01-.707-.293l-9-9a1 1 0 011.414-1.414L10 17.586l8.293-8.293a1 1 0 011.414 1.414l-9 9A1 1 0 0110 20z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414L13.414 10l-4.707 4.707a1 1 0 01-1.414 0z" />
                        </svg>
                        <a href="#"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ $title }}</a>
                    </div>
                </li>
            </ol>
        </nav>


        <!-- Main Content -->
        <div class="container">
            {{ $slot }}
        </div>

    </div>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#schedulesTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                dom: '<"flex flex-col md:flex-row items-center justify-between"<"mb-4 md:mb-0"l><"md:ml-4"f>>rt<"flex flex-col md:flex-row items-center justify-between"<"mb-4 md:mb-0"i><"md:ml-4"p>>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass(
                        'px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500'
                    );
                    $('.dataTables_length select').addClass(
                        'px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500'
                    );
                    $('.dataTables_paginate .paginate_button').addClass(
                        'px-3 py-1 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50'
                    );
                    $('.dataTables_paginate .paginate_button.current').addClass(
                        'bg-blue-50 text-blue-600 border-blue-200');
                }
            });
        });
    </script>


    {{-- Script --}}
    <script>
        // Display current date
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('currentDate').textContent =
            now.toLocaleDateString('id-ID', options);

        // Profile dropdown functionality
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const myProfileBtn = document.getElementById('myProfileBtn');
        const logoutBtn = document.getElementById('logoutBtn');

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // My Profile functionality
        myProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            profileDropdown.classList.add('hidden');

            // Show profile modal or redirect to profile page
            alert('Redirect ke halaman My Profile untuk pengaturan akun');
        });

        // Logout functionality
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if (confirm('Apakah Anda yakin ingin logout?')) {
                // Show logout process
                logoutBtn.innerHTML = `
                    <svg class="w-4 h-4 mr-3 text-red-500 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Logging out...
                `;

                setTimeout(() => {
                    alert('Logout berhasil! Redirect ke halaman login...');
                    // window.location.href = '/login';
                }, 1500);
            }
        });

        // Form submission handling
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show success message
            const button = e.target.querySelector('button[type="submit"]');
            const originalText = button.textContent;
            button.textContent = 'Mengirim...';
            button.disabled = true;

            setTimeout(() => {
                button.textContent = 'Terkirim ✓';
                button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                button.classList.add('bg-green-600');

                setTimeout(() => {
                    button.textContent = originalText;
                    button.disabled = false;
                    button.classList.remove('bg-green-600');
                    button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    e.target.reset();
                }, 2000);
            }, 1500);
        });

        // Update status indicators periodically
        setInterval(() => {
            const indicators = document.querySelectorAll('.bg-green-500, .bg-yellow-500');
            indicators.forEach(indicator => {
                indicator.style.opacity = '0.3';
                setTimeout(() => {
                    indicator.style.opacity = '1';
                }, 500);
            });
        }, 5000);
    </script>
</body>

</html>

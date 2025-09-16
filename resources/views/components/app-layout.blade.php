<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease-in-out;
            z-index: 40;
        }
        .btn-anim {
            transition: all 0.3s ease;
        }
        .btn-anim:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        .overlay {
            transition: opacity 0.3s ease-in-out;
        }
        .main-content {
            transition: margin-left 0.3s ease-in-out;
        }
        @media (min-width: 768px) {
            .sidebar-closed .sidebar {
                transform: translateX(-100%);
                position: absolute;
            }
            .sidebar-closed .main-content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-open .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen" id="main-container">

    <!-- Sidebar -->
    <aside id="sidebar"
           class="sidebar bg-purple-700 text-white w-64 p-6 fixed inset-y-0 left-0 md:relative md:left-0 z-40">
        <h2 class="text-2xl font-bold mb-6">Menu</h2>
        <nav class="space-y-3">
            <a href="{{ route('projects.index') }}"
               class="block px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-800 transition btn-anim">
                Project
            </a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('projects.create') }}"
               class="block px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-800 transition btn-anim">
                Create Project
            </a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg btn-anim">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Overlay (mobile) -->
    <div id="overlay" class="overlay fixed inset-0 bg-black bg-opacity-50 hidden z-30 md:hidden"></div>

    <!-- Content Area -->
    <div class="main-content flex-1 flex flex-col md:ml-0 transition-all duration-300">

        <!-- Navbar -->
        <header class="bg-purple-800 text-white shadow-md p-4 flex justify-between items-center">
            <!-- Toggle button - selalu terlihat -->
            <button id="toggleSidebar"
            class="p-2 rounded-md bg-purple-600 hover:bg-purple-700 transition">
            ☰
        </button>
        <div class="text-lg font-semibold">
            {{ Auth::user()->name ?? 'Guest' }}
        </div>
    </header>

        <!-- Page Content -->
        <main class="p-6 flex-1 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</div>

<script>
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");
    const overlay = document.getElementById("overlay");
    const mainContainer = document.getElementById("main-container");
    const mainContent = document.querySelector('.main-content');
    let isSidebarOpen = window.innerWidth >= 768;

    function updateSidebarState() {
        if (window.innerWidth >= 768) {
            // Desktop view
            overlay.classList.add("hidden");
            if (isSidebarOpen) {
                sidebar.classList.remove("transform", "-translate-x-full");
                mainContainer.classList.remove("sidebar-closed");
                mainContainer.classList.add("sidebar-open");
                mainContent.classList.remove("md:ml-0");
                mainContent.classList.add("md:ml-64");
            } else {
                sidebar.classList.add("transform", "-translate-x-full");
                mainContainer.classList.add("sidebar-closed");
                mainContainer.classList.remove("sidebar-open");
                mainContent.classList.add("md:ml-0");
                mainContent.classList.remove("md:ml-64");
            }
        } else {
            // Mobile view
            mainContainer.classList.remove("sidebar-closed", "sidebar-open");
            mainContent.classList.remove("md:ml-64");
            mainContent.classList.add("md:ml-0");

            if (isSidebarOpen) {
                sidebar.classList.remove("-translate-x-full");
                overlay.classList.remove("hidden");
                setTimeout(() => {
                    overlay.classList.remove("opacity-0");
                    overlay.classList.add("opacity-100");
                }, 10);
            } else {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.remove("opacity-100");
                overlay.classList.add("opacity-0");
                setTimeout(() => {
                    overlay.classList.add("hidden");
                }, 300);
            }
        }
    }

    function openSidebar() {
        isSidebarOpen = true;
        updateSidebarState();
    }

    function closeSidebar() {
        isSidebarOpen = false;
        updateSidebarState();
    }

    toggleBtn.addEventListener("click", () => {
        if (isSidebarOpen) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    overlay.addEventListener("click", closeSidebar);

    // Handle window resize
    window.addEventListener('resize', updateSidebarState);

    // Initialize sidebar state
    updateSidebarState();
</script>

</body>
</html>

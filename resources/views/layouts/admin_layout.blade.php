<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sponsor - Sponsorify</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/95327fac23.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <div class="navbar bg-neutral text-neutral-content">
            <div class="navbar-start">
                <div class="drawer lg:hidden">
                    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content">
                        <!-- Page content here -->
                        <label for="my-drawer" class="drawer-button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block w-6 h-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>
                    <div class="drawer-side">
                        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                        <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                            <!-- Sidebar content here -->
                            <li><a href="/admin/withdraw">Pencairan</a></li>
                            <li><a href="/admin/payment">Pembayaran</a></li>
                            <li><a href="/admin/report">Laporan</a></li>
                        </ul>
                    </div>
                </div>
                <a class="btn btn-ghost text-xl">Sponsorify</a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="/admin/withdraw">Pencairan</a></li>
                    <li><a href="/admin/payment">Pembayaran</a></li>
                    <li><a href="/admin/report">Laporan</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                <div class="flex gap-2">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="https://avatar.iran.liara.run/public" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                            <li>
                                <a class="justify-between">
                                    Profile
                                </a>
                            </li>
                            <li><a>Settings</a></li>
                            <li>
                                <form action="/auth/logout" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="shadow-lg border border-black my-4 mx-4 rounded-lg">
        @yield('content')
    </div>
</body>

</html>

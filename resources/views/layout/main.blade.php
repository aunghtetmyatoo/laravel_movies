<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Movie app</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body x-data="{ scrolled: false, top: false }" x-init="() => {
    window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 100
    });
}" class="macro font-sans bg-black text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex items-center flex-col md:flex-row">
                <li>
                    <a href="{{ route('movies.index') }}">
                        <img src="/img/cinema.svg" alt="avatar" class="w-12 h-12">
                    </a>
                </li>
                <li class="md:ml-10 mt-3 md:mt-0">
                    <a href="{{ route('movies.index') }}" class="hover:text-gray-300">Movies</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('tv.index') }}" class="hover:text-gray-300">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
                </li>
            </ul>
            <div class="flex items-center flex-col md:flex-row">
                <livewire:search-dropdown />
            </div>
        </div>
    </nav>
    <a href="#" x-show="scrolled" x-cloak
        @click="top = true; if (top) { window.scrollTo({top: 0, behavior: 'smooth'}); top = false; }"
        class="goTop fixed bottom-0 right-0 z-50 cursor-pointer text-white bounce 2s infinite transition duration-500 ease-in-out"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90">
        <img src="https://images.freeimages.com/fic/images/icons/744/juicy_fruit/256/top_arrow.png" alt="ViberLogo"
            width="60px" height="60px" class="opacity-60">
    </a>
    @yield('content')

    @livewireScripts
    @yield('script')
</body>
<script>
    document.querySelector('.goTop').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('.macro').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

</html>

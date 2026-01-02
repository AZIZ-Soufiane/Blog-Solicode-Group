<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicode Blog - @yield('title', 'Accueil')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/solicode-logo.png') }}" type="image/x-icon">

    <!-- Google Fonts Inter & Outfit -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vite Assets (Tailwind CSS + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->

</head>

<body class="bg-gray-50 flex flex-col min-h-screen dark:bg-slate-900">

    @include('Visitor.partials.nav')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('Visitor.partials.footer')

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Haut de page"
        class="fixed bottom-8 right-8 z-50 p-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition-all duration-300 transform translate-y-10 opacity-0 invisible focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 dark:focus:ring-offset-slate-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    @stack('scripts')
</body>

</html>
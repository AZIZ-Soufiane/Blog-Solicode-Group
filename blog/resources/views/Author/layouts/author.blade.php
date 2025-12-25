<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Auteur - SolicodeBlog</title>
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white text-gray-900">

    @include('author.partials.sidebar')
 
   <main
  id="content"
  role="main"
  class="w-full min-h-screen pt-10 px-4 sm:px-6 md:px-8 lg:pl-72 bg-gray-50"
> 

        @yield('content')
    </main>

    @stack('scripts')
    
    @vite('resources/js/authorDashboard.js')

</body> 
</html>

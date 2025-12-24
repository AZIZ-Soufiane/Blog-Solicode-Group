<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
 
@vite(['resources/js/app.js','resources/css/app.css'])

</head>
<body class="bg-white text-gray-900">

    @include('admin.partials.sidebar')
       {{--  @include('admin.partials.header') --}}
 
   <main
  id="content"
  role="main"
  class="w-full min-h-screen pt-10 px-4 sm:px-6 md:px-8 lg:pl-72 bg-gray-50"
> 

        @yield('content')
    </main>

   @stack('scripts')
   

</body> 
</html>

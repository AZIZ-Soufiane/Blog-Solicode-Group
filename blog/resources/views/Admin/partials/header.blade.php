<!-- ========== HEADER ========== -->
<header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 w-full bg-white border-b border border-gray-200 text-sm p-5" >
  <nav class="w-full mx-auto px-4 sm:px-6 lg:px-8 flex basis-full items-center w-full mx-auto lg:pl-64">
    <div class="me-5 lg:hidden">
      <!-- Logo Mobile -->
      <a class="flex items-center gap-x-2 focus:outline-none" href="#" aria-label="Solicode Logo">
          <img src="{{ asset('images/logosolicode.png') }}" alt="Solicode Logo" class="w-32 h-auto">
      </a>
    </div>

    <div class="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">
      
      <!-- Search Input -->
      <div class="hidden md:block">
        <div class="relative group">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5 group-focus-within:text-blue-600 transition-colors">
            <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
          </div>
          <input type="text" class="py-2 ps-10 pe-16 block w-full md:w-80 bg-gray-50 border-transparent rounded-xl text-sm focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none transition-all placeholder:text-gray-400" placeholder="Rechercher...">
          <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-3 text-gray-400">
            <kbd class="hidden md:inline-flex items-center gap-x-1 py-0.5 px-1.5 rounded-md border border-gray-200 bg-white text-[10px] font-medium text-gray-400">
                ⌘ K
            </kbd>
          </div>
        </div>
      </div>

      <div class="flex flex-row items-center justify-end gap-2">
        
        <!-- Mobile Search Toggle -->
        <button type="button" class="md:hidden size-9 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
          <i data-lucide="search" class="w-4 h-4"></i>
        </button>


        <!-- Dropdown -->
        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
          <button id="hs-dropdown-account" type="button" class="size-9 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <img class="shrink-0 size-10 rounded-full object-cover ring-2 ring-gray-100" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
          </button>

          <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-2xl rounded-2xl border border-gray-100 mt-2 z-50 p-2" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
            <div class="py-3 px-5 bg-gradient-to-br from-gray-50 to-white border-b border-gray-100 rounded-t-2xl mb-1">
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Connecté en tant que</p>
              <p class="text-sm font-bold text-gray-900 truncate">admin@solicode.co</p>
            </div>
            <div class="p-1 space-y-0.5">
              <a class="flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all font-medium" href="#">
                <i data-lucide="user-circle" class="w-4 h-4"></i>
                Mon Profil
              </a>
              <a class="flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all font-medium" href="#">
                <i data-lucide="settings" class="w-4 h-4"></i>
                Paramètres
              </a>
            </div>
            <div class="my-1.5 border-t border-gray-100"></div>
            <div class="p-1">
              <a class="flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm text-red-600 hover:bg-red-50 hover:shadow-sm transition-all font-bold" href="#">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                Se déconnecter
              </a>
            </div>
          </div>
        </div>
        <!-- End Dropdown -->
      </div>
    </div>
  </nav>
</header>
<!-- ========== END HEADER ========== -->
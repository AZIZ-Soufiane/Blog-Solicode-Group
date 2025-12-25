@extends('admin.layouts.admin')

@section('content')

    <div class="mb-5 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Liste des articles</h1>
        <a href="{{ route('admin.articles.create') }}" 
           class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Nouvel article
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

        <!-- Articles Table -->
    <div class="bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700">
      <div class="p-4 overflow-x-auto">
        <div class="flex flex-wrap items-center mb-4 gap-4 justify-end">
          <div>
            <label class="sr-only" for="articleSearch">Rechercher</label>
            <input id="articleSearch" type="text" placeholder="Rechercher par titre..."
              class="py-2 px-4 pr-8 block w-full bg-white border border-gray-200 text-gray-800 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
          </div>
          <!-- Categories Custom Dropdown -->
          <div id="categoriesDropdown" class="relative inline-block text-left">
            <button type="button"
              class="inline-flex justify-between items-center w-full sm:w-56 py-2 px-4 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-slate-800">
              <span class="truncate">Toutes les catégories</span>
              <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
            </button>

            <div
              class="hidden absolute top-full left-0 sm:left-auto sm:right-0 mt-2 w-56 bg-white sm:shadow-xl rounded-lg p-2 dark:bg-gray-800 border border-gray-200 dark:border-gray-700"
              style="z-index: 9999;">

              <!-- Toutes catégories (Reset option) -->


              <!-- Laravel -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="?category=laravel">
                <svg class="w-4 h-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="m12 19 7-7 3 3-7 7-3-3z" />
                  <path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z" />
                  <path d="m2 2 7.586 7.586" />
                  <circle cx="11" cy="11" r="2" />
                </svg>
                Laravel
              </a>

              <!-- PHP -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="?category=php">
                <svg class="w-4 h-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5" />
                  <path d="M8.5 8.5v.01" />
                  <path d="M16 12v.01" />
                  <path d="M12 16v.01" />
                </svg>
                PHP
              </a>

              <!-- Android -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="?category=android">
                <svg class="w-4 h-4 text-green-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                  <path d="M12 18h.01" />
                </svg>
                Android
              </a>

              <!-- Design -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="?category=design">
                <svg class="w-4 h-4 text-pink-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path
                    d="m21.64 3.64-1.28-1.28a1.21 1.21 0 0 0-1.72 0L2.36 18.64a1.21 1.21 0 0 0 0 1.72l1.28 1.28a1.2 1.2 0 0 0 1.72 0L21.64 5.36a1.2 1.2 0 0 0 0-1.72Z" />
                  <path d="m14 7 3 3" />
                  <path d="M5 6v4" />
                  <path d="M19 14v4" />
                  <path d="M10 2v2" />
                  <path d="M7 8H3" />
                  <path d="M21 16h-4" />
                  <path d="M11 3H9" />
                </svg>
                Design
              </a>

              <!-- Éducation -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="?category=education">
                <svg class="w-4 h-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                  <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
                Éducation
              </a>

              <!-- Activités -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="?category=activities">
                <svg class="w-4 h-4 text-cyan-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.71-2.16 0-3" />
                  <path d="m2.3 2.3 7.2 7.2" />
                  <path d="m14 11 9-9" />
                  <path d="m9 14-7 9" />
                  <path d="m21.7 21.7-7.2-7.2" />
                  <path d="M11 14c-1.26 1.5-5 2-5 2s.5-3.74 2-5c.84-.71 2.16-.71 3 0" />
                  <path d="M13 10c1.26-1.5 5-2 5-2s-.5 3.74-2 5c-.84.71-2.16.71-3 0" />
                </svg>
                Activités
              </a>
            </div>
          </div>

          <!-- Status Custom Dropdown -->
          <div id="statusDropdown" class="relative inline-block text-left">
            <button type="button"
              class="inline-flex justify-between items-center w-full sm:w-56 py-2 px-4 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-slate-800">
              <span class="truncate">Tous les statuts</span>
              <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
            </button>

            <div
              class="hidden absolute top-full left-0 sm:left-auto sm:right-0 mt-2 w-56 bg-white sm:shadow-xl rounded-lg p-2 dark:bg-gray-800 border border-gray-200 dark:border-gray-700"
              style="z-index: 9999;">

              <!-- Tous statuts (Reset) -->


              <!-- Publié -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="#">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-green-500"></i>
                Publié
              </a>

              <!-- Brouillon -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="#">
                <i data-lucide="file-edit" class="w-4 h-4 text-gray-500"></i>
                Brouillon
              </a>

              <!-- Archivé -->
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium text-gray-800 hover:bg-blue-50 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors"
                href="#">
                <i data-lucide="archive" class="w-4 h-4 text-red-500"></i>
                Archivé
              </a>
            </div>
          </div>
        </div>

        <table id="articlesTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead>
            <tr>

              <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                ARTICLE</th>
              <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                AUTEUR</th>
              <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                CATÉGORIE</th>
              <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                STATUT</th>
              <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                DATE DE CRÉATION</th>
              <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            <!-- Row 1 -->
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors">
              <td class="px-3 py-4 whitespace-nowrap">
                <div class="flex items-center gap-3">

                  <div class="text-sm font-medium text-gray-900 dark:text-white">Solicode Tangier: Empowering Youth...
                  </div>
                </div>
              </td>
              <td class="px-3 py-4 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <div
                    class="h-6 w-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs font-bold">
                    AF
                  </div>
                  <span class="text-sm text-gray-600 dark:text-gray-400">Ayoub Faqihi</span>
                </div>
              </td>
              <td class="px-3 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-slate-800 dark:text-gray-200">
                  Education
                </span>
              </td>
              <td class="px-3 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                  Publié
                </span>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                19 Dec 2025
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button
                  class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800"
                  data-edit-btn title="Modifier">
                  <i data-lucide="pencil" class="w-4 h-4 text-gray-600 dark:text-gray-400"></i>
                </button>
                <button
                  class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800"
                  data-delete-btn title="Supprimer">
                  <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                </button>
              </td>
            </tr>
            <!-- Row 2 -->
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors">
              <td class="px-3 py-4 whitespace-nowrap">
                <div class="flex items-center gap-3">

                  <div class="text-sm font-medium text-gray-900 dark:text-white">IT-Wave: Celebrating Digital
                    Innovation...</div>
                </div>
              </td>
              <td class="px-3 py-4 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <div
                    class="h-6 w-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                    YH</div>
                  <span class="text-sm text-gray-600 dark:text-gray-400">Yassine Hajjar</span>
                </div>
              </td>
              <td class="px-3 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-slate-800 dark:text-gray-200">
                  Activities
                </span>
              </td>
              <td class="px-3 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                  Publié
                </span>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                19 Dec 2025
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button
                  class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800"
                  data-edit-btn title="Modifier">
                  <i data-lucide="pencil" class="w-4 h-4 text-gray-600 dark:text-gray-400"></i>
                </button>
                <button
                  class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800"
                  data-delete-btn title="Supprimer">
                  <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="pagination" class="flex justify-center items-center gap-2 mt-4"></div>
      </div>
    </div>

    

@endsection

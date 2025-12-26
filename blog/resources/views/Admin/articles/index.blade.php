@extends('admin.layouts.admin')

@section('content')

    <div class="mb-5 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Liste des articles</h1>
        <a href="{{ route('admin.articles.create') }}" 
           class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
            <i data-lucide="plus" class="w-4 h-4"></i>
            {{ __('articles.labels.add') }}
        </a>
    </div>

    <div id="alert-container">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <!-- Articles Table -->
    <!-- Articles Table -->
    <div class="bg-white border border-gray-200 shadow-sm rounded-xl">
      <!-- Header / Filter -->
      <div class="p-4 border-b border-gray-200 rounded-t-xl">
        <!-- Filter Form -->
        <form id="filterForm" method="GET" action="{{ route('admin.articles.index') }}" class="flex flex-wrap items-center gap-4 justify-end">
          
          <!-- Search -->
          <div class="flex-1 min-w-[200px]">
            <label class="sr-only" for="articleSearch">Rechercher</label>
            <input id="articleSearch" type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par titre..."
              class="py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

          <!-- Categories Dropdown (Preline UI) -->
          <div class="relative min-w-[200px]">
             <select name="category" data-hs-select='{
                "placeholder": "Toutes les catégories",
                "toggleTag": "<button type=\"button\"></button>",
                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-400 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1]",
                "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100",
                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
             }' class="hidden">
                <option value="all" data-content="<div class='flex items-center w-full'><span class='text-gray-800'>Toutes les catégories</span></div>">
                    Toutes les catégories
                </option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" 
                            {{ request('category') == $category->slug ? 'selected' : '' }}
                            data-content="<div class='flex items-center w-full'><img class='size-6 rounded-full mr-2' src='{{ $category->image ? Storage::url($category->image) : asset('default-cat.png') }}' alt='{{ $category->name }}'><span class='text-gray-800'>{{ $category->name }}</span></div>">
                        {{ $category->name }}
                    </option>
                @endforeach
             </select>
          </div>

          <!-- Status Dropdown -->
          <div class="relative min-w-[200px]">
             <select name="status" data-hs-select='{
                "placeholder": "Tous les statuts",
                "toggleTag": "<button type=\"button\"></button>",
                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-400 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1]",
                "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100",
                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
             }' class="hidden">
                <option value="all" data-content="<div class='flex items-center w-full'><span class='text-gray-800'>Tous les statuts</span></div>">
                    Tous les statuts
                </option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archivé</option>
             </select>
          </div>
        </form>
      </div>

      <!-- Table Section Container -->
      <div id="articlesTableContainer">
          @include('admin.articles.partials.table')
      </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('articleSearch');
        const categorySelect = document.querySelector('select[name="category"]');
        const statusSelect = document.querySelector('select[name="status"]');
        const tableContainer = document.getElementById('articlesTableContainer');

        let timeout = null;

        function fetchArticles(url = "{{ route('admin.articles.index') }}") {
            const params = new URLSearchParams();
            if (searchInput.value) params.append('search', searchInput.value);
            if (categorySelect.value) params.append('category', categorySelect.value);
            if (statusSelect.value) params.append('status', statusSelect.value);

            // Fetch with params
            fetch(`${url}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                tableContainer.innerHTML = html;
                window.createLucideIcons(); // Re-init icons
            })
            .catch(error => console.error('Error:', error));
        }

        // Event Listeners
        const filterForm = document.getElementById('filterForm');
        
        // Prevent default form submission (enter key)
        if(filterForm) {
            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchArticles();
            });
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchArticles();
            }, 300);
        });

        // Use change event for native selects
        // Preline UI updates the native select value and should trigger change event
        
        categorySelect.addEventListener('change', () => {
             console.log('Category changed');
             fetchArticles();
        });

        statusSelect.addEventListener('change', () => {
             console.log('Status changed');
             fetchArticles();
        });

        // Pagination Links
        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                const url = e.target.closest('.pagination a').getAttribute('href');
                if (url) {
                    fetchArticles(url.split('?')[0]); // fetchArticles appends params, so we pass base URL? 
                    // No, pagination links usually contain params. 
                    // We should merge params.
                    // Actually simplified: Just use the URL from the link, but we want to PERSIST current filters.
                    // Laravel pagination links usually append current query strings if configured.
                    // To be safe, we use the Base URL and append our current JS state params.
                    // Or we extract the page number.
                    
                    const urlObj = new URL(url);
                    const page = urlObj.searchParams.get('page');
                    
                    const currentUrl = new URL("{{ route('admin.articles.index') }}");
                    if (page) {
                       // We want to fetch with current filters + new page
                       // We can just append page to our fetch params
                       const params = new URLSearchParams();
                        if (searchInput.value) params.append('search', searchInput.value);
                        if (categorySelect.value) params.append('category', categorySelect.value);
                        if (statusSelect.value) params.append('status', statusSelect.value);
                        params.append('page', page);
                        
                         fetch(`${currentUrl}?${params.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            tableContainer.innerHTML = html;
                            window.createLucideIcons();
                        });
                    }
                }
            }
        });

        // Helper to show dynamic alerts
        function showAlert(message, type = 'success') {
            const container = document.getElementById('alert-container');
            const colorClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
            
            const alertHtml = `
                <div class="mb-4 ${colorClass} px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">${message}</span>
                </div>
            `;
            
            container.innerHTML = alertHtml;
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        // Delete Article Handler
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('[data-delete-article]');
            if (deleteBtn) {
                e.preventDefault();
                
                const articleId = deleteBtn.getAttribute('data-delete-article');
                const articleTitle = deleteBtn.getAttribute('data-article-title');
                
                if (confirm(`Êtes-vous sûr de vouloir supprimer l'article "${articleTitle}" ?`)) {
                    // Get CSRF token from meta tag
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    fetch(`{{ route('admin.articles.index') }}/${articleId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the table row
                            const row = deleteBtn.closest('tr');
                            if (row) {
                                row.style.transition = 'opacity 0.3s';
                                row.style.opacity = '0';
                                setTimeout(() => {
                                    row.remove();
                                    
                                    // Check if table is empty
                                    const tbody = document.querySelector('#articlesTable tbody');
                                    if (tbody && tbody.querySelectorAll('tr').length === 0) {
                                        tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucun article trouvé.</td></tr>';
                                    }
                                }, 300);
                            }
                            
                            // Show dynamic success message from lang
                            showAlert(data.message, 'success');
                        } else {
                            showAlert(data.message || 'Erreur lors de la suppression.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('Une erreur est survenue lors de la suppression.', 'error');
                    });
                }
            }
        });
    });
</script>
@endpush

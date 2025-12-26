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
    <!-- Articles Table -->
    <div class="bg-white border border-gray-200 shadow-sm rounded-xl overflow-hidden">
      <!-- Header / Filter -->
      <div class="p-4 border-b border-gray-200">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.articles.index') }}" class="flex flex-wrap items-center gap-4 justify-end">
          
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
                <option value="">Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
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
                <option value="">Tous les statuts</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archivé</option>
             </select>
          </div>

          <div>
              <button type="submit" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                Filtrer
              </button>
          </div>
        </form>
      </div>

      <!-- Table Section -->
      <div class="overflow-x-auto w-full">
        <table id="articlesTable" class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ARTICLE</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AUTEUR</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CATÉGORIE</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUT</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DATE DE CRÉATION</th>
              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            @forelse($articles as $article)
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-3">
                  <div class="text-sm font-medium text-gray-900">{{ Str::limit($article->title, 40) }}</div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-2">
                  <div class="h-6 w-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold">
                    {{ substr($article->user->name ?? '?', 0, 2) }}
                  </div>
                  <span class="text-sm text-gray-600">{{ $article->user->name ?? 'Inconnu' }}</span>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @foreach($article->categories as $cat)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                  {{ $cat->name }}
                </span>
                @if(!$loop->last) @endif
                @endforeach
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @php
                    $statusColors = [
                        'published' => 'bg-green-100 text-green-800',
                        'draft' => 'bg-gray-100 text-gray-800',
                        'archived' => 'bg-red-100 text-red-800',
                    ];
                    $statusLabels = [
                        'published' => 'Publié',
                        'draft' => 'Brouillon',
                        'archived' => 'Archivé',
                    ];
                    $status = $article->status;
                    $color = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                    $label = $statusLabels[$status] ?? $status;
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                  {{ $label }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $article->created_at->format('d M Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.articles.edit', $article) }}"
                       class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition-colors"
                       title="Modifier">
                      <i data-lucide="pencil" class="w-4 h-4 text-gray-600"></i>
                    </a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition-colors"
                           title="Supprimer">
                          <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                        </button>
                    </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucun article trouvé.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Footer / Pagination -->
      <div class="px-4 py-4 border-t border-gray-200">
          {{ $articles->links() }}
      </div>
    </div>

    

@endsection

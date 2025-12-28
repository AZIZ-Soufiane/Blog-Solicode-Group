<!-- Table Section -->
<div class="overflow-x-auto w-full">
    <table id="articlesTable" class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ARTICLE</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    AUTEUR</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CATÉGORIE</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    STATUT</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DATE DE CRÉATION</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions</th>
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
                            <div
                                class="h-6 w-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold">
                                {{ substr($article->user->name ?? '?', 0, 2) }}
                            </div>
                            <span class="text-sm text-gray-600">{{ $article->user->name ?? 'Inconnu' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($article->categories as $cat)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
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
                            <a href="{{ route('author.articles.edit', $article) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition-colors"
                                title="Modifier">
                                <i data-lucide="pencil" class="w-4 h-4 text-gray-600"></i>
                            </a>
                            <button type="button" data-delete-article="{{ $article->id }}"
                                data-article-title="{{ $article->title }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-red-50 transition-colors"
                                title="Supprimer">
                                <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                            </button>
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
<div class="px-4 py-4 border-t border-gray-200 rounded-b-xl">
    {{ $articles->links() }}
</div>
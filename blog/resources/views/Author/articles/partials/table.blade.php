<div class="overflow-x-auto w-full">
    <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ARTICLE</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CATÉGORIE</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    STATUT</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    DATE</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ACTIONS</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse($articles as $article)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($article->title, 40) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($article->categories as $cat)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $cat->name }}
                            </span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'published' => 'bg-green-100 text-green-800',
                                'draft' => 'bg-yellow-100 text-yellow-800',
                                'archived' => 'bg-red-100 text-red-800',
                            ];
                            $statusLabels = [
                                'published' => 'Publié',
                                'draft' => 'Brouillon',
                                'archived' => 'Archivé',
                            ];
                            $color = $statusColors[$article->status] ?? 'bg-gray-100 text-gray-800';
                            $label = $statusLabels[$article->status] ?? $article->status;
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
                            <form action="{{ route('author.articles.destroy', $article) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Êtes-vous sûr ?');">
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
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Vous n'avez aucun article pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="px-4 py-4 border-t border-gray-200 rounded-b-xl">
    {{ $articles->links() }}
</div>
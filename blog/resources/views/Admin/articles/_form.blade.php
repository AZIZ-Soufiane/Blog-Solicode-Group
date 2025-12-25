<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Content -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Title & Slug -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5">
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium mb-2 text-gray-800">{{ __('articles.labels.title') }}</label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $article->title ?? '') }}"
                           class="py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800 @error('title') border-red-500 @enderror"
                           placeholder="Titre de l'article" required>
                    @error('title')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium mb-2 text-gray-800">{{ __('articles.labels.slug') }}</label>
                    <input type="text" id="slug" name="slug"
                           value="{{ old('slug', $article->slug ?? '') }}"
                           class="py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm bg-gray-50 text-gray-500"
                           placeholder="Slug de l'article" readonly>
                    @error('slug')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Content (CKEditor) -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5">
            <label for="content" class="block text-sm font-medium mb-2 text-gray-800">{{ __('articles.labels.content') }}</label>
            <style>
                .ck-editor__editable_inline {
                    height: 300px;
                    overflow-y: auto;
                }
                .ck-content img {
                    max-width: 100%;
                    height: auto;
                    margin: 1rem auto;
                    border-radius: 0.5rem;
                }
                .ck-content h1 { font-size: 2em; font-weight: bold; margin-bottom: 0.5rem; margin-top: 1rem; }
                .ck-content h2 { font-size: 1.5em; font-weight: bold; margin-bottom: 0.5rem; margin-top: 1rem; }
                .ck-content h3 { font-size: 1.17em; font-weight: bold; margin-bottom: 0.5rem; margin-top: 1rem; }
                .ck-content ul { list-style-type: disc; padding-left: 2rem; margin-bottom: 1rem; }
                .ck-content ol { list-style-type: decimal; padding-left: 2rem; margin-bottom: 1rem; }
                .ck-content a { color: blue; text-decoration: underline; }
                .ck-content blockquote { border-left: 4px solid #ccc; margin-left: 1rem; padding-left: 1rem; font-style: italic; }
            </style>
            <div class="border border-gray-400 rounded-xl overflow-hidden @error('content') border-red-500 @enderror">
                <textarea id="article-content" name="content">{{ old('content', $article->content ?? '') }}</textarea>
            </div>
            @error('content')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Video (Full Width in Left Column) -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5">
            <h3 class="font-semibold text-gray-800 mb-4">{{ __('articles.labels.videos') }}</h3>
            <label for="dropzone-video"
                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-400 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <i data-lucide="video" class="w-8 h-8 mb-3 text-gray-400"></i>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquer pour upload</span></p>
                    <p class="text-xs text-center text-gray-500">MP4, WebM, AVI (Max 500Mo)<br>Pour sélectionner plusieurs, maintenez Ctrl</p>
                </div>
                <input id="dropzone-video" type="file" name="videos[]" class="hidden" accept="video/*" multiple />
            </label>
            
            <!-- Selected Videos List -->
            <div id="selected-videos-list" class="mt-4 space-y-2 hidden">
                <!-- Videos will be listed here by JS -->
            </div>
            
                @if(isset($article) && $article->videos)
                <div class="mt-4 space-y-2">
                    @foreach($article->videos as $video)
                        <div class="text-sm text-gray-600">
                            <i data-lucide="film" class="inline w-4 h-4 mr-1"></i> Vidéo existante
                        </div>
                    @endforeach
                </div>
            @endif
            @error('videos')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Right Column: Settings -->
    <div class="space-y-6">

        <!-- Publish Status -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5">
            <h3 class="font-semibold text-gray-800 mb-4">Publication</h3>
            <div class="space-y-4">
                <div>
                    <label for="status" class="block text-sm font-medium mb-2 text-gray-800">{{ __('articles.labels.status') }}</label>
                    <select id="status" name="status"
                            class="py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="draft" {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>{{ __('articles.status.draft') }}</option>
                        <option value="published" {{ old('status', $article->status ?? '') == 'published' ? 'selected' : '' }}>{{ __('articles.status.published') }}</option>
                        <option value="archived" {{ old('status', $article->status ?? '') == 'archived' ? 'selected' : '' }}>{{ __('articles.status.archived') }}</option>
                    </select>
                    @error('status')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-between items-center">
                    <label for="is_featured" class="text-sm text-gray-500">{{ __('articles.labels.is_featured') }}</label>
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1"
                           {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }}
                           class="relative w-[3.25rem] h-7 bg-gray-100 checked:bg-none checked:bg-blue-600 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 ring-1 ring-transparent focus:border-blue-600 focus:ring-blue-600 ring-offset-white focus:outline-none appearance-none before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
                </div>
            </div>
        </div>

        <!-- Taxonomy -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5">
            <h3 class="font-semibold text-gray-800 mb-4">Taxonomie</h3>
            <div class="space-y-6">

                <!-- Categories Preline Select -->
                <div class="relative">
                    <label for="categories" class="block text-sm font-medium mb-2 text-gray-800">{{ __('articles.labels.categories') }}</label>
                    <select id="categories" name="categories[]" multiple="" data-hs-select='{
                        "placeholder": "Sélectionner...",
                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50",
                        "mode": "tags",
                        "wrapperClasses": "relative ps-0.5 pe-9 min-h-[46px] flex items-center flex-wrap text-nowrap w-full border border-gray-400 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500",
                        "tagsItemTemplate": "<div class=\"flex flex-nowrap items-center relative z-10 bg-white border border-gray-200 rounded-full p-1 m-1\"><div class=\"whitespace-nowrap text-gray-800 px-2\" data-title></div><div class=\"inline-flex shrink-0 justify-center items-center size-5 ms-2 rounded-full text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-gray-400 text-sm cursor-pointer\" data-remove><svg class=\"shrink-0 size-3\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg></div></div>",
                        "tagsInputId": "hs-tags-input",
                        "tagsInputClasses": "py-2 px-2 min-w-[50px] border-transparent focus:ring-0 text-sm outline-none bg-transparent order-1",
                        "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"text-sm font-semibold text-gray-800 \" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' class="hidden">
                        <option value="">Choisir...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (collect(old('categories', isset($article) ? $article->categories->pluck('id') : []))->contains($category->id)) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags Input -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-800">{{ __('articles.labels.tags') }}</label>
                    <div class="relative">
                        <!-- We assume tags are passed as a JSON array of names for autocomplete -->
                        <input type="text" id="tags-input" name="tags"
                               value="{{ old('tags', isset($article) ? $article->tags->pluck('name')->implode(', ') : '') }}"
                               class="py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="#Tag1, #Tag2..."
                               data-available-tags="{{ $tags->pluck('name')->toJson() }}">

                        <!-- Tag Suggestions Dropdown -->
                        <div id="tags-dropdown"
                             class="hidden absolute left-0 right-0 top-full mt-1 z-50 bg-white border border-gray-200 rounded-lg shadow-lg max-h-40 overflow-y-auto">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Séparez les tags par des virgules.</p>
                    @error('tags')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                <!-- Image de couverture (Inside Taxonomy) -->
                <div>
                    <h3 class="font-semibold text-gray-800 mb-4">{{ __('articles.labels.image') }}</h3>
                    
                    <!-- Hidden input to track if image should be removed -->
                    <input type="hidden" name="remove_image" id="remove_image" value="0">

                    <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-400 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors overflow-hidden relative group">
                        
                        <div id="image-preview-default" class="flex flex-col items-center justify-center pt-5 pb-6 {{ (isset($article) && $article->image) ? 'hidden' : '' }}">
                            <i data-lucide="cloud-upload" class="w-8 h-8 mb-3 text-gray-400"></i>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquer pour upload</span></p>
                        </div>
                        
                        <div id="image-preview-container" class="absolute inset-0 flex items-center justify-center bg-gray-50 {{ (isset($article) && $article->image) ? '' : 'hidden' }}">
                            @if(isset($article) && $article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Couverture" class="w-full h-full object-cover">
                            @endif
                            
                            <!-- Remove Image Button -->
                            <button type="button" id="btn-remove-image" 
                                    class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <input id="dropzone-file" type="file" name="image" class="hidden" accept="image/*" />
                    </label>
                        @error('image')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Bottom Action Button -->
<div class="mt-6 flex justify-start">
    <button type="submit"
            class="py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
        {{ $buttonLabel ?? 'Enregistrer' }}
    </button>
</div>



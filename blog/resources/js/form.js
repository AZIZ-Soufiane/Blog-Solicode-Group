
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {

    // === CKEditor Initialization ===
    const contentEditor = document.querySelector('#article-content');

    // Define Custom Upload Adapter
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = () => {
                        resolve({ default: reader.result });
                    };
                    reader.onerror = error => reject(error);
                    reader.readAsDataURL(file);
                }));
        }

        abort() {
            // Reject the promise if needed
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    if (contentEditor) {
        ClassicEditor
            .create(contentEditor, {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'imageUpload', '|',
                    'undo', 'redo'
                ]
            })
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
                    // Force text color to black for the editor content specifically
                    writer.setStyle('color', '#000000', editor.editing.view.document.getRoot());
                    writer.setStyle('background-color', '#ffffff', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });
    }

    // === Slug Generation ===
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function () {
            const slug = titleInput.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');

            slugInput.value = slug;
        });
    }

    // === File Upload Feedback (Video) ===
    const videoInput = document.getElementById('dropzone-video');
    const videoDataTransfer = new DataTransfer();
    const selectedVideosList = document.getElementById('selected-videos-list');

    function updateVideosList() {
        if (!selectedVideosList) return;

        const files = videoDataTransfer.files;

        if (files.length === 0) {
            selectedVideosList.classList.add('hidden');
            selectedVideosList.innerHTML = '';
            return;
        }

        selectedVideosList.classList.remove('hidden');
        selectedVideosList.innerHTML = '<h4 class="text-sm font-semibold text-gray-700 mb-2">Fichiers sélectionnés :</h4>';

        Array.from(files).forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg px-3 py-2';

            const fileInfo = document.createElement('div');
            fileInfo.className = 'flex items-center gap-2 flex-1 min-w-0';

            const icon = document.createElement('i');
            icon.setAttribute('data-lucide', 'video');
            icon.className = 'w-4 h-4 text-gray-500 flex-shrink-0';

            const fileName = document.createElement('span');
            fileName.className = 'text-sm text-gray-700 truncate';
            fileName.textContent = file.name;

            const fileSize = document.createElement('span');
            fileSize.className = 'text-xs text-gray-500 flex-shrink-0';
            fileSize.textContent = `(${(file.size / 1024 / 1024).toFixed(2)} Mo)`;

            fileInfo.appendChild(icon);
            fileInfo.appendChild(fileName);
            fileInfo.appendChild(fileSize);

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.className = 'flex-shrink-0 p-1 text-red-600 hover:bg-red-50 rounded transition-colors';
            deleteBtn.innerHTML = '<i data-lucide="trash-2" class="w-4 h-4"></i>';
            deleteBtn.setAttribute('data-index', index);
            deleteBtn.addEventListener('click', function () {
                removeVideoFile(parseInt(this.getAttribute('data-index')));
            });

            fileItem.appendChild(fileInfo);
            fileItem.appendChild(deleteBtn);
            selectedVideosList.appendChild(fileItem);
        });

        // Reinitialize Lucide icons for the new elements
        if (window.createLucideIcons) {
            window.createLucideIcons();
        }
    }

    function removeVideoFile(index) {
        // Create a new DataTransfer without the file at the specified index
        const newDataTransfer = new DataTransfer();
        const files = Array.from(videoDataTransfer.files);

        files.forEach((file, i) => {
            if (i !== index) {
                newDataTransfer.items.add(file);
            }
        });

        // Clear the old DataTransfer
        while (videoDataTransfer.items.length > 0) {
            videoDataTransfer.items.remove(0);
        }

        // Add all files from the new DataTransfer
        Array.from(newDataTransfer.files).forEach(file => {
            videoDataTransfer.items.add(file);
        });

        // Update the input
        if (videoInput) {
            videoInput.files = videoDataTransfer.files;
        }

        updateVideosList();
    }

    if (videoInput) {
        videoInput.addEventListener('change', function (e) {
            // Add new files to the DataTransfer object
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                // Check if file is already in the list to avoid duplicates
                let exists = false;
                const currentFiles = Array.from(videoDataTransfer.files);

                // 1. Check against new selection
                if (currentFiles.some(f => f.name === file.name && f.size === file.size)) {
                    exists = true;
                }

                // 2. Check against uploaded videos (by name)
                const existingVideos = document.querySelectorAll('.existing-video-item');
                existingVideos.forEach(item => {
                    const originalName = item.getAttribute('data-original-name');
                    if (originalName === file.name && !item.classList.contains('hidden')) {
                        exists = true;
                    }
                });

                if (!exists) {
                    videoDataTransfer.items.add(file);
                } else {
                    alert('Vidéo déjà existe : ' + file.name);
                }
            }

            // Update the input's files property to the accumulated list
            this.files = videoDataTransfer.files;

            updateVideosList();
        });
    }

    // === File Upload Feedback (Image Coverage) ===
    const imageInput = document.getElementById('dropzone-file');
    const removeImageInput = document.getElementById('remove_image');
    const btnRemoveImage = document.getElementById('btn-remove-image');
    const previewDefault = document.getElementById('image-preview-default');
    const previewContainer = document.getElementById('image-preview-container');

    if (imageInput) {
        imageInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    // Update preview inside the dropzone
                    if (previewDefault && previewContainer) {
                        previewDefault.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        previewContainer.innerHTML = `
                            <img src="${event.target.result}" alt="Aperçu" class="w-full h-full object-cover">
                            <button type="button" id="btn-remove-image" 
                                    class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full transition-opacity z-20"
                                    title="Supprimer">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        `;

                        // Re-attach delete logic for the dynamically created button
                        const newBtn = previewContainer.querySelector('#btn-remove-image');
                        if (newBtn) {
                            newBtn.addEventListener('click', handleImageRemoval);
                        }
                    }

                    // Reset removal flag
                    if (removeImageInput) {
                        removeImageInput.value = "0";
                    }

                    // Reinitialize Lucide icons
                    if (window.createLucideIcons) {
                        window.createLucideIcons();
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }

    function handleImageRemoval(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Reset input file
        if (imageInput) {
            imageInput.value = "";
        }

        // Hide preview, show default
        if (previewDefault && previewContainer) {
            previewDefault.classList.remove('hidden');
            previewContainer.classList.add('hidden');
            previewContainer.innerHTML = '';
        }

        // Set removal flag for backend
        if (removeImageInput) {
            removeImageInput.value = "1";
        }
    }

    if (btnRemoveImage) {
        btnRemoveImage.addEventListener('click', handleImageRemoval);
    }

    // === Tags Input (Comma Separated) with Autocomplete ===
    const tagsInput = document.getElementById('tags-input');
    const tagsDropdown = document.getElementById('tags-dropdown');

    if (tagsInput && tagsDropdown) {
        const rawAvailableTags = tagsInput.dataset.availableTags || '[]';
        let existingTags = [];
        try {
            existingTags = JSON.parse(rawAvailableTags);
            if (existingTags.length > 0 && typeof existingTags[0] === 'object') {
                existingTags = existingTags.map(t => t.name);
            }
        } catch (e) {
            console.error("Error parsing available tags", e);
        }

        function getCurrentTags() {
            return tagsInput.value.split(',').map(t => t.trim().replace(/^#/, '')).filter(t => t);
        }

        function getCurrentPartial() {
            const val = tagsInput.value;
            const lastCommaIndex = val.lastIndexOf(',');
            return val.substring(lastCommaIndex + 1);
        }

        function selectTag(tag) {
            const val = tagsInput.value;
            const lastCommaIndex = val.lastIndexOf(',');
            let newVal = '';
            const tagWithHash = '#' + tag;

            if (lastCommaIndex === -1) {
                newVal = tagWithHash + ', ';
            } else {
                newVal = val.substring(0, lastCommaIndex + 1) + ' ' + tagWithHash + ', ';
            }
            tagsInput.value = newVal;

            tagsInput.focus();
            closeTagsDropdown();
        }

        function showSuggestions() {
            tagsDropdown.innerHTML = '';
            const partial = getCurrentPartial().trim().replace(/^#/, '').toLowerCase();
            const currentTags = getCurrentTags().map(t => t.toLowerCase());

            if (!partial && existingTags.length > 50) return;

            const matches = existingTags.filter(t => {
                const lowerT = t.toLowerCase();
                const isAlreadySelected = currentTags.includes(lowerT);
                const matchesPartial = partial === '' || lowerT.includes(partial);
                return !isAlreadySelected && matchesPartial;
            });

            if (matches.length > 0) {
                tagsDropdown.classList.remove('hidden');
                matches.forEach(tag => {
                    const div = document.createElement('div');
                    div.className = "px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm text-gray-800";
                    div.textContent = '#' + tag;
                    div.addEventListener('click', () => selectTag(tag));
                    tagsDropdown.appendChild(div);
                });
            } else {
                closeTagsDropdown();
            }
        }

        function closeTagsDropdown() {
            tagsDropdown.classList.add('hidden');
        }

        tagsInput.addEventListener('input', () => {
            showSuggestions();
        });

        tagsInput.addEventListener('focus', () => {
            showSuggestions();
        });

        document.addEventListener('click', (e) => {
            if (!tagsInput.contains(e.target) && !tagsDropdown.contains(e.target)) {
                closeTagsDropdown();
            }
        });
    }

    // === Existing Video Removal ===
    const existingVideoButtons = document.querySelectorAll('.btn-remove-existing-video');
    const deleteContainer = document.getElementById('videos-to-delete-container');

    existingVideoButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const item = this.closest('.existing-video-item');
            const videoId = item.dataset.videoId;

            // Add hidden input to form
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_videos[]';
            input.value = videoId;
            deleteContainer.appendChild(input);

            // Hide the item from view
            item.classList.add('hidden');
        });
    });
});

{{-- resources/views/admin/portfolio/create.blade.php --}}
@extends('admin.layouts.app')

@push('styles')
    <style>
        .file-drop-area {
            position: relative;
            border: 2px dashed #cbd5e1;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .file-drop-area.is-dragover {
            background-color: #e2e8f0;
            border-color: #3B4BA6;
        }

        .file-preview {
            margin-top: 0.5rem;
            position: relative;
        }

        .file-preview img {
            max-height: 150px;
            width: auto;
            border-radius: 0.375rem;
            margin: 0 auto;
        }

        .remove-preview {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            padding: 0.25rem;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 640px) {
            .file-drop-area {
                padding: 1rem;
            }

            .file-preview img {
                max-height: 120px;
            }

            .file-message svg {
                height: 2rem;
                width: 2rem;
            }
        }

        .loading-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3B4BA6;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h2 class="text-xl sm:text-2xl font-bold">Add New Project</h2>
            <a href="{{ route('admin.portfolio.index') }}" class="text-blue-600 inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Portfolio
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Common Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Type</label>
                        <select name="type" id="projectType"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($constants['types'] as $value => $label)
                                <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sub Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Sub-Type</label>
                        <select name="sub_type" id="projectSubType"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </select>
                        @error('sub_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Status</label>
                        <select name="project_status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($constants['statuses'] as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('project_status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Client Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Client Name</label>
                        <input type="text" name="client_name" value="{{ old('client_name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- File Upload Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Before Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Before Image</label>
                        <div class="file-drop-area" id="beforeImageDrop">
                            <input type="file" name="before_image" id="beforeImage" class="hidden" accept="image/*">
                            <div class="file-message">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-600">Drop image here or click to upload</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <div class="file-preview hidden" id="beforeImagePreview"></div>
                            <div class="loading-overlay">
                                <div class="loading-spinner"></div>
                            </div>
                        </div>
                        @error('before_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- After Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">After Image</label>
                        <div class="file-drop-area" id="afterImageDrop">
                            <input type="file" name="after_image" id="afterImage" class="hidden" accept="image/*">
                            <div class="file-message">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-600">Drop image here or click to upload</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <div class="file-preview hidden" id="afterImagePreview"></div>
                            <div class="loading-overlay">
                                <div class="loading-spinner"></div>
                            </div>
                        </div>
                        @error('after_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Dynamic Fields Container -->
                <div id="dynamicFields" class="space-y-6">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Project Details -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Description</label>
                        <textarea name="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Technologies Used</label>
                        <input type="text" name="technologies" value="{{ old('technologies') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="e.g., Laravel, Vue.js, PostgreSQL (comma-separated)">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Key Features</label>
                        <input type="text" name="features" value="{{ old('features') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Key features (comma-separated)">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Challenges</label>
                            <textarea name="challenges" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('challenges') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Solutions</label>
                            <textarea name="solutions" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('solutions') }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-700">
                            Feature this project
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.portfolio.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Create Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const projectTypeSelect = document.getElementById('projectType');
                const dynamicFields = document.getElementById('dynamicFields');
                const subTypeSelect = document.getElementById('projectSubType');

                // Sub-types data
                const subTypes = @json($constants['subTypes']);

                function updateSubTypes(type) {
                    subTypeSelect.innerHTML = '';
                    if (subTypes[type]) {
                        Object.entries(subTypes[type]).forEach(([value, label]) => {
                            const option = new Option(label, value);
                            subTypeSelect.add(option);
                        });
                    }
                }

                function setupFileUpload(dropAreaId, inputId, previewId) {
                    const dropArea = document.getElementById(dropAreaId);
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    const fileMessage = dropArea.querySelector('.file-message');
                    const loadingOverlay = dropArea.querySelector('.loading-overlay');

                    dropArea.addEventListener('click', () => input.click());

                    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                        dropArea.addEventListener(eventName, preventDefaults, false);
                    });

                    function preventDefaults(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    ['dragenter', 'dragover'].forEach(eventName => {
                        dropArea.addEventListener(eventName, () => {
                            dropArea.classList.add('is-dragover');
                        });
                    });
                    ['dragleave', 'drop'].forEach(eventName => {
                        dropArea.addEventListener(eventName, () => {
                            dropArea.classList.remove('is-dragover');
                        });
                    });

                    dropArea.addEventListener('drop', handleDrop);
                    input.addEventListener('change', handleFileSelect);

                    function handleDrop(e) {
                        const dt = e.dataTransfer;
                        const files = dt.files;
                        handleFiles(files);
                    }

                    function handleFileSelect(e) {
                        const files = e.target.files;
                        handleFiles(files);
                    }

                    function handleFiles(files) {
                        if (files.length > 0) {
                            const file = files[0];

                            // Validate file type
                            if (!file.type.startsWith('image/')) {
                                alert('Please upload an image file');
                                return;
                            }

                            // Validate file size (2MB)
                            if (file.size > 2 * 1024 * 1024) {
                                alert('File size should not exceed 2MB');
                                return;
                            }

                            updatePreview(file);
                            input.files = files;
                        }
                    }

                    function updatePreview(file) {
                        loadingOverlay.style.display = 'flex';

                        const reader = new FileReader();

                        reader.onload = (e) => {
                            preview.innerHTML = `
                    <div class="relative">
                        <img src="${e.target.result}" alt="Preview" class="mx-auto max-h-48 rounded-lg">
                        <button type="button" class="remove-preview" onclick="removePreview('${dropAreaId}', '${inputId}', '${previewId}')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;

                            preview.classList.remove('hidden');
                            fileMessage.classList.add('hidden');
                            loadingOverlay.style.display = 'none';
                        };

                        reader.readAsDataURL(file);
                    }
                }

                function getWebsiteFields() {
                    return `
            <div class="space-y-6">
                <!-- URLs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Live URL</label>
                        <input type="url" name="live_url" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">GitHub URL</label>
                        <input type="url" name="github_url" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://github.com/username/repo">
                    </div>
                </div>
            </div>
        `;
                }

                function getWebAppFields() {
                    return `
            <div class="space-y-6">
                ${getWebsiteFields()}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Access Type</label>
                        <select name="access_type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($constants['accessTypes'] as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">User Base</label>
                        <input type="number" name="user_base" min="0"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">User Roles</label>
                    <input type="text" name="user_roles" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="e.g., Admin, Manager, User (comma-separated)">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Modules/Components</label>
                    <input type="text" name="modules" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="e.g., Authentication, Dashboard, Reports (comma-separated)">
                </div>
            </div>
        `;
                }

                function getDocumentFields() {
                    return `
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sample File</label>
                        <input type="file" name="sample_file" 
                               class="mt-1 block w-full text-sm" accept=".pdf,.doc,.docx,.ppt,.pptx">
                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, PPT, PPTX up to 10MB</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Number of Pages</label>
                        <input type="number" name="number_of_pages" min="1"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Formatting Style</label>
                    <input type="text" name="formatting_style" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="e.g., APA, MLA, Chicago">
                </div>
            </div>
        `;
                }

                function updateDynamicFields() {
                    const type = projectTypeSelect.value;
                    let fields = '';

                    switch (type) {
                        case 'website':
                            fields = getWebsiteFields();
                            break;
                        case 'webapp':
                            fields = getWebAppFields();
                            break;
                        case 'document':
                        case 'presentation':
                            fields = getDocumentFields();
                            break;
                        case 'software':
                            fields = getWebsiteFields(); // Modify as needed for software
                            break;
                    }

                    dynamicFields.innerHTML = fields;
                    updateSubTypes(type);
                }

                projectTypeSelect.addEventListener('change', updateDynamicFields);
                updateDynamicFields(); // Initial load

                // Initialize file uploads
                setupFileUpload('beforeImageDrop', 'beforeImage', 'beforeImagePreview');
                setupFileUpload('afterImageDrop', 'afterImage', 'afterImagePreview');
            });

            // Global function for removing previews
            function removePreview(dropAreaId, inputId, previewId) {
                const dropArea = document.getElementById(dropAreaId);
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                const fileMessage = dropArea.querySelector('.file-message');

                input.value = '';
                preview.innerHTML = '';
                preview.classList.add('hidden');
                fileMessage.classList.remove('hidden');
            }
        </script>
    @endpush
@endsection

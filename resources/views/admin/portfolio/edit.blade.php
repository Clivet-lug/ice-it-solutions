{{-- resources/views/admin/portfolio/edit.blade.php --}}
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

        .existing-image {
            position: relative;
            margin-bottom: 1rem;
        }

        .existing-image img {
            border-radius: 0.375rem;
            max-height: 150px;
            width: auto;
            margin: 0 auto;
        }

        @media (max-width: 640px) {
            .file-drop-area {
                padding: 1rem;
            }

            .file-preview img,
            .existing-image img {
                max-height: 120px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h2 class="text-xl sm:text-2xl font-bold">Edit Project</h2>
            <a href="{{ route('admin.portfolio.index') }}" class="text-blue-600 inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Portfolio
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.portfolio.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Common Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}"
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
                                <option value="{{ $value }}"
                                    {{ old('type', $project->type) == $value ? 'selected' : '' }}>
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
                                    {{ old('project_status', $project->project_status) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Client Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Client Name</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Images Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Before Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Before Image</label>
                        @if ($project->before_image)
                            <div class="existing-image" id="existingBeforeImage">
                                <img src="{{ Storage::url($project->before_image) }}" alt="Before" class="shadow">
                                <button type="button" class="remove-preview" onclick="removeExistingImage('before')"
                                    title="Remove image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif

                        <div class="file-drop-area" id="beforeImageDrop"
                            style="{{ $project->before_image ? 'display: none;' : '' }}">
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
                        </div>
                        <input type="hidden" name="remove_before_image" id="removeBeforeImage" value="0">
                        @error('before_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- After Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">After Image</label>
                        @if ($project->after_image)
                            <div class="existing-image" id="existingAfterImage">
                                <img src="{{ Storage::url($project->after_image) }}" alt="After" class="shadow">
                                <button type="button" class="remove-preview" onclick="removeExistingImage('after')"
                                    title="Remove image">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endif

                        <div class="file-drop-area" id="afterImageDrop"
                            style="{{ $project->after_image ? 'display: none;' : '' }}">
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
                        </div>
                        <input type="hidden" name="remove_after_image" id="removeAfterImage" value="0">
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
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Technologies Used</label>
                        <input type="text" name="technologies"
                            value="{{ old('technologies', is_array($project->technologies) ? implode(', ', $project->technologies) : $project->technologies) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="e.g., Laravel, Vue.js, PostgreSQL (comma-separated)">
                    </div>

                    <!-- Features -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Key Features</label>
                        <input type="text" name="features"
                            value="{{ old('features', is_array($project->features) ? implode(', ', $project->features) : $project->features) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Key features (comma-separated)">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Challenges</label>
                            <textarea name="challenges" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('challenges', $project->challenges) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Solutions</label>
                            <textarea name="solutions" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('solutions', $project->solutions) }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-700">
                            Feature this project
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.portfolio.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update Project
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
                const currentSubType = '{{ old('sub_type', $project->sub_type) }}';

                function updateSubTypes(type) {
                    subTypeSelect.innerHTML = '';
                    if (subTypes[type]) {
                        Object.entries(subTypes[type]).forEach(([value, label]) => {
                            const option = new Option(label, value);
                            if (value === currentSubType) {
                                option.selected = true;
                            }
                            subTypeSelect.add(option);
                        });
                    }
                }

                function setupFileUpload(dropAreaId, inputId, previewId) {
                    const dropArea = document.getElementById(dropAreaId);
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    const fileMessage = dropArea.querySelector('.file-message');

                    if (!dropArea) return; // Exit if element doesn't exist

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
                        };

                        reader.readAsDataURL(file);
                    }
                }

                function getWebsiteFields() {
                    const project = @json($project);
                    return `
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Live URL</label>
                        <input type="url" name="live_url" 
                               value="${project.live_url || ''}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">GitHub URL</label>
                        <input type="url" name="github_url" 
                               value="${project.github_url || ''}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://github.com/username/repo">
                    </div>
                </div>
            </div>
        `;
                }

                function getWebAppFields() {
                    const project = @json($project);
                    return `
            <div class="space-y-6">
                ${getWebsiteFields()}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Access Type</label>
                        <select name="access_type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($constants['accessTypes'] as $value => $label)
                                <option value="{{ $value }}" ${project.access_type === '{{ $value }}' ? 'selected' : ''}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">User Base</label>
                        <input type="number" name="user_base" 
                               value="${project.user_base || ''}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">User Roles</label>
                    <input type="text" name="user_roles" 
                           value="${Array.isArray(project.user_roles) ? project.user_roles.join(', ') : (project.user_roles || '')}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="e.g., Admin, Manager, User (comma-separated)">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Modules/Components</label>
                    <input type="text" name="modules" 
                           value="${Array.isArray(project.modules) ? project.modules.join(', ') : (project.modules || '')}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="e.g., Authentication, Dashboard, Reports (comma-separated)">
                </div>
            </div>
        `;
                }

                function getDocumentFields() {
                    const project = @json($project);
                    return `
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sample File</label>
                        ${project.sample_file ? `
                                    <div class="mb-2">
                                        <a href="${project.sample_file_url}" 
                                           class="text-blue-600 hover:text-blue-800" 
                                           target="_blank">
                                            Current File
                                        </a>
                                    </div>
                                ` : ''}
                        <input type="file" name="sample_file" 
                               class="mt-1 block w-full text-sm" 
                               accept=".pdf,.doc,.docx,.ppt,.pptx">
                        <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, PPT, PPTX up to 10MB</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Number of Pages</label>
                        <input type="number" name="number_of_pages" 
                               value="${project.number_of_pages || ''}"
                               min="1"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Formatting Style</label>
                    <input type="text" name="formatting_style" 
                           value="${project.formatting_style || ''}"
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

            // Global functions for handling images
            function removeExistingImage(type) {
                const existingImageDiv = document.getElementById(
                `existing${type.charAt(0).toUpperCase() + type.slice(1)}Image`);
                const dropArea = document.getElementById(`${type}ImageDrop`);
                const removeInput = document.getElementById(`remove${type.charAt(0).toUpperCase() + type.slice(1)}Image`);

                existingImageDiv.style.display = 'none';
                dropArea.style.display = 'block';
                removeInput.value = '1';
            }

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

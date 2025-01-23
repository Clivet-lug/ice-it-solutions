@extends('layouts.app')

@section('content')
    <div class="bg-[#3B4BA6]/5 min-h-screen py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Request {{ $service->name }}</h1>
                    <p class="mt-2 text-gray-600">Fill out the form below and we'll get back to you shortly.</p>
                </div>

                <form id="serviceRequestForm" action="{{ route('services.submit-request') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <!-- Personal Details Section -->
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name"
                                class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors"
                                placeholder="Your full name" required>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email"
                                class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors"
                                placeholder="your@email.com" required>
                        </div>
                    </div>

                    <!-- Project Details Section -->
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Project Description</label>
                            <textarea name="description" rows="4"
                                class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors resize-none"
                                placeholder="Tell us about your project requirements..." required></textarea>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Attachments</label>
                            <div class="mt-2">
                                <label
                                    class="block w-full px-4 py-3 rounded-xl border border-dashed border-gray-300 hover:border-[#3B4BA6] transition-colors cursor-pointer">
                                    <input type="file" name="attachments[]" multiple class="hidden"
                                        onChange="updateFileList(this)">
                                    <div class="text-center" id="dropzone-text">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m4-4h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-1 text-sm text-gray-600">Drop files here or click to upload</p>
                                    </div>
                                    <div id="file-list" class="mt-2 hidden">
                                        <ul class="text-sm text-gray-600 space-y-1"></ul>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-[#3B4BA6] text-white px-6 py-3 rounded-xl hover:bg-[#2D3A8C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B4BA6] transition-colors duration-300">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateFileList(input) {
                const fileList = document.querySelector('#file-list');
                const fileListUl = fileList.querySelector('ul');
                const dropzoneText = document.querySelector('#dropzone-text');

                fileListUl.innerHTML = '';

                if (input.files.length > 0) {
                    fileList.classList.remove('hidden');
                    dropzoneText.classList.add('hidden');

                    Array.from(input.files).forEach(file => {
                        const li = document.createElement('li');
                        li.className = 'flex items-center';
                        li.innerHTML = `
               <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
               </svg>
               ${file.name}
           `;
                        fileListUl.appendChild(li);
                    });
                } else {
                    fileList.classList.add('hidden');
                    dropzoneText.classList.remove('hidden');
                }
            }
        </script>
    @endpush

    @push('scripts')
        <script>
            const form = document.getElementById('serviceRequestForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                // Loading state
                Swal.fire({
                    title: 'Submitting Request',
                    html: 'Please wait while we process your request...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your request has been submitted successfully.',
                                icon: 'success',
                                confirmButtonColor: '#3B4BA6',
                            }).then(() => {
                                window.location.href = document.referrer; // Redirect to previous page
                            });
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error',
                            text: error.message || 'An error occurred while submitting your request.',
                            icon: 'error',
                            confirmButtonColor: '#3B4BA6'
                        });
                    });
            });

            function updateFileList(input) {
                // Your existing file list update code
            }
        </script>
    @endpush
@endsection

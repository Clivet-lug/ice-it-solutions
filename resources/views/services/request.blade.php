@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-8">Request {{ $service->name }}</h1>

                <form id="serviceRequestForm" action="{{ route('services.submit-request') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <!-- Personal Details -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Name
                        </label>
                        <input type="text" name="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Email
                        </label>
                        <input type="email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <!-- Project Details -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Project Description
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Attachments (if any)
                        </label>
                        <input type="file" name="attachments[]" multiple
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Submit Request
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript for the push alerts --}}
    @push('scripts')
        <script>
            // Get the form element
            const form = document.getElementById('serviceRequestForm');

            // Add submit event listener
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Create FormData object
                const formData = new FormData(this);

                // Show loading alert
                Swal.fire({
                    title: 'Submitting Request...',
                    text: 'Please wait while we process your request.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Use fetch to submit the form
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                confirmButtonColor: '#3B82F6'
                            }).then((result) => {
                                // Redirect after user clicks OK
                                window.location.href = data.redirect;
                            });
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message || 'Something went wrong!',
                            confirmButtonColor: '#3B82F6'
                        });
                    });
            });

            // Your existing file validation code remains the same
        </script>
    @endpush
@endsection

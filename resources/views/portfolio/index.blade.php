@extends('layouts.app')

@push('styles')
    <style>
        /* Loading state for images */
        .image-loading {
            position: relative;
            background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite linear;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Smooth transitions for filtering */
        .project-card {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card.hidden {
            opacity: 0;
            transform: translateY(20px);
        }

        /* Enhanced hover effects */
        .project-card:hover .project-image {
            transform: scale(1.1) rotate(-1deg);
        }

        .project-card:hover .before-image {
            opacity: 1;
            transform: scale(1);
        }

        .before-image {
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* View toggle transitions */
        .view-transition {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Technology tags hover effect */
        .tech-tag {
            transition: all 0.3s ease;
        }

        .tech-tag:hover {
            background-color: #3B4BA6;
            color: white;
            transform: translateY(-1px);
        }

        /* Sort and filter buttons */
        .filter-button {
            transition: all 0.3s ease;
        }

        .filter-button:hover:not(.active) {
            background-color: #3B4BA6/5;
            transform: translateY(-1px);
        }

        .filter-button.active {
            position: relative;
        }

        .filter-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background-color: #3B4BA6;
            border-radius: 2px;
        }

        /* Search input styling */
        .search-input:focus {
            box-shadow: 0 0 0 2px rgba(59, 75, 166, 0.2);
        }
    </style>
@endpush
@section('content')
    <div class="bg-[#3B4BA6]/5 min-h-screen">
        <!-- Search and Filter Header -->
        <div class="max-w-7xl mx-auto pt-8 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <!-- Search Bar -->
                <div class="relative w-full sm:w-96">
                    <input type="text" id="searchInput" placeholder="Search projects..."
                        class="w-full px-4 py-2 pl-10 pr-4 rounded-lg border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-all duration-300">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- View Toggle & Sort -->
                <div class="flex items-center space-x-4">
                    <select id="sortSelect"
                        class="rounded-lg border border-gray-200 text-sm focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name">Name A-Z</option>
                        <option value="name-desc">Name Z-A</option>
                    </select>

                    <div class="flex items-center space-x-2 border border-gray-200 rounded-lg p-1">
                        <button id="gridView"
                            class="p-2 rounded hover:bg-[#3B4BA6]/10 active:bg-[#3B4BA6]/20 transition-colors"
                            aria-label="Grid View">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                        <button id="listView"
                            class="p-2 rounded hover:bg-[#3B4BA6]/10 active:bg-[#3B4BA6]/20 transition-colors"
                            aria-label="List View">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Pills -->
            <div class="mt-6 flex flex-wrap items-center gap-3">
                <button
                    class="filter-button active px-4 py-2 rounded-full text-sm font-medium bg-white border border-gray-200 hover:border-[#3B4BA6]/30"
                    data-type="all">
                    All Projects
                </button>
                @foreach (['website', 'webapp', 'software', 'document', 'presentation'] as $type)
                    <button
                        class="filter-button px-4 py-2 rounded-full text-sm font-medium bg-white border border-gray-200 hover:border-[#3B4BA6]/30"
                        data-type="{{ $type }}">
                        {{ ucfirst($type) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Featured Projects Section -->
        @if ($featured->count() > 0)
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900">Featured Projects</h2>
                    <div class="w-20 h-1 bg-[#3B4BA6] mx-auto rounded-full mt-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featured as $project)
                        @include('portfolio.partials.project-card', [
                            'project' => $project,
                            'featured' => true,
                        ])
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Main Projects Grid -->
        <div class="max-w-7xl mx-auto pb-16 px-4 sm:px-6 lg:px-8">
            <div id="projectsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 view-transition">
                @foreach ($portfolios as $project)
                    @include('portfolio.partials.project-card', [
                        'project' => $project,
                        'featured' => false,
                    ])
                @endforeach
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No projects found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.
                </p>
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="hidden">
                <div class="animate-pulse grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                            <div class="aspect-video bg-gray-200"></div>
                            <div class="p-6 space-y-3">
                                <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                                <div class="h-6 bg-gray-200 rounded w-3/4"></div>
                                <div class="h-4 bg-gray-200 rounded w-full"></div>
                                <div class="h-4 bg-gray-200 rounded w-2/3"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const projectsGrid = document.getElementById('projectsGrid');
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            const filterButtons = document.querySelectorAll('.filter-button');
            const gridViewBtn = document.getElementById('gridView');
            const listViewBtn = document.getElementById('listView');
            const emptyState = document.getElementById('emptyState');
            const loadingState = document.getElementById('loadingState');

            let currentFilter = 'all';
            let currentView = 'grid';
            let projects = Array.from(document.querySelectorAll('.project-card'));

            // Initialize Intersection Observer for lazy loading
            const observerOptions = {
                root: null,
                rootMargin: '50px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target.querySelector('img');
                        if (img && img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            projects.forEach(project => observer.observe(project));

            // View Toggle
            function setView(view) {
                currentView = view;
                projectsGrid.classList.remove('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3');

                if (view === 'grid') {
                    projectsGrid.classList.add('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3');
                    gridViewBtn.classList.add('bg-[#3B4BA6]/10');
                    listViewBtn.classList.remove('bg-[#3B4BA6]/10');
                } else {
                    projectsGrid.classList.add('grid-cols-1');
                    listViewBtn.classList.add('bg-[#3B4BA6]/10');
                    gridViewBtn.classList.remove('bg-[#3B4BA6]/10');
                }
            }

            gridViewBtn.addEventListener('click', () => setView('grid'));
            listViewBtn.addEventListener('click', () => setView('list'));

            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const type = button.dataset.type;
                    currentFilter = type;

                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    filterProjects();
                });
            });

            // Search functionality
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterProjects();
                }, 300);
            });

            // Sort functionality
            sortSelect.addEventListener('change', () => {
                sortProjects();
                filterProjects();
            });

            function sortProjects() {
                const sortValue = sortSelect.value;
                projects.sort((a, b) => {
                    switch (sortValue) {
                        case 'name':
                            return a.dataset.name.localeCompare(b.dataset.name);
                        case 'name-desc':
                            return b.dataset.name.localeCompare(a.dataset.name);
                        case 'newest':
                            return new Date(b.dataset.date) - new Date(a.dataset.date);
                        case 'oldest':
                            return new Date(a.dataset.date) - new Date(b.dataset.date);
                        default:
                            return 0;
                    }
                });
            }

            function filterProjects() {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleCount = 0;

                projects.forEach(project => {
                    const type = project.dataset.type;
                    const name = project.dataset.name.toLowerCase();
                    const shouldShow = (currentFilter === 'all' || type === currentFilter) &&
                        name.includes(searchTerm);

                    if (shouldShow) {
                        project.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        project.classList.add('hidden');
                    }
                });

                // Show/hide empty state
                emptyState.classList.toggle('hidden', visibleCount > 0);

                // Reapply sort order
                const sortedProjects = Array.from(projects);
                sortProjects();

                // Reorder DOM elements
                sortedProjects.forEach(project => {
                    projectsGrid.appendChild(project);
                });
            }

            // Initialize view
            setView('grid');
        });
    </script>
@endpush

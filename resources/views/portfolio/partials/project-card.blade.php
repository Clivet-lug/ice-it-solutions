<div class="project-card bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group"
    data-type="{{ $project->type }}" data-name="{{ $project->title }}" data-date="{{ $project->completion_date }}">

    <div class="relative aspect-video overflow-hidden bg-gray-50">
        @if ($project->after_image)
            <div class="image-loading absolute inset-0"></div>
            <img src="{{ Storage::url($project->after_image) }}" alt="{{ $project->title }}"
                class="project-image w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
                onerror="this.onerror=null; this.src='/images/placeholder.jpg';"
                onload="this.previousElementSibling.remove()">

            @if ($project->before_image)
                <div
                    class="before-image absolute inset-0 bg-black/75 opacity-0 group-hover:opacity-100 flex items-center justify-center">
                    <img src="{{ Storage::url($project->before_image) }}" alt="Before"
                        class="max-h-[80%] max-w-[80%] object-contain rounded shadow-lg">
                </div>
            @endif

            @if (isset($featured) && $featured)
                <div class="absolute top-4 right-4">
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-md bg-green-100 text-green-800 text-xs font-medium">
                        Featured
                    </span>
                </div>
            @endif
        @else
            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </div>

    <div class="p-6">
        <div class="flex items-center gap-2">
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#3B4BA6]/10 text-[#3B4BA6]">
                {{ ucfirst($project->type) }}
                @if ($project->sub_type)
                    <span class="mx-1 text-[#3B4BA6]/50">&middot;</span>
                    {{ ucfirst($project->sub_type) }}
                @endif
            </span>
        </div>

        <h3 class="text-xl font-bold mt-3 text-gray-900">{{ $project->title }}</h3>

        @if ($project->client_name)
            <p class="text-gray-500 text-sm">Client: {{ $project->client_name }}</p>
        @endif

        <p class="text-gray-600 mt-2 text-sm line-clamp-2 group-hover:line-clamp-none transition-all duration-300">
            {{ $project->description }}
        </p>

        @php
            $technologies = is_string($project->technologies)
                ? json_decode($project->technologies, true)
                : $project->technologies;
        @endphp

        @if (!empty($technologies))
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($technologies as $tech)
                    <span
                        class="tech-tag px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600 hover:bg-[#3B4BA6] hover:text-white transition-colors">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        @endif

        <a href="{{ route('portfolio.show', $project) }}"
            class="inline-flex items-center text-[#3B4BA6] font-medium mt-4 hover:translate-x-2 transition-transform duration-300">
            View Project
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>

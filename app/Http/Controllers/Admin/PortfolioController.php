<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\HasImages;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Constants\PortfolioConstants;
use Illuminate\Support\Facades\Storage;
use App\Traits\HasImages as TraitsHasImages;

class PortfolioController extends Controller
{
    use TraitsHasImages;

    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $constants = [
            'types' => PortfolioConstants::PROJECT_TYPES,
            'subTypes' => PortfolioConstants::SUB_TYPES,
            'statuses' => PortfolioConstants::PROJECT_STATUS,
            'confidentialityLevels' => PortfolioConstants::CONFIDENTIALITY_LEVELS,
            'accessTypes' => PortfolioConstants::ACCESS_TYPES,
            'complexityLevels' => PortfolioConstants::COMPLEXITY_LEVELS,
        ];

        return view('admin.portfolio.create', compact('constants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:website,webapp,software,document,presentation',
            'sub_type' => 'required|string|max:255',
            'description' => 'required',
            'client_name' => 'nullable|max:255',
            'before_image' => 'nullable|image|max:2048',
            'after_image' => $request->type == 'website' ? 'required|image|max:2048' : 'nullable|image|max:2048',
            'results' => 'nullable',
            'technologies' => 'nullable|string',
            'features' => 'nullable|string',
            'project_status' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'complexity_level' => 'nullable|integer|min:1|max:5',
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'access_type' => $request->type == 'webapp' ? 'required|string' : 'nullable|string',
            'user_base' => 'nullable|integer',
            'sample_file' => $request->type == 'document' || $request->type == 'presentation'
                ? 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240'
                : 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'formatting_style' => 'nullable|string',
            'number_of_pages' => 'nullable|integer',
            'document_type' => 'nullable|string',
            'confidentiality_level' => 'nullable|string',
            'client_testimonial' => 'nullable|string',
            'client_position' => 'nullable|string',
            'testimonial_date' => 'nullable|date',
            'is_featured' => 'boolean'
        ]);

        // Handle image uploads
        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $this->storeImage(
                $request->file('before_image'),
                'portfolio/before'
            );
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $this->storeImage(
                $request->file('after_image'),
                'portfolio/after'
            );
        }

        // Handle sample file upload
        if ($request->hasFile('sample_file')) {
            $validated['sample_file'] = $request->file('sample_file')
                ->store('portfolio/samples', 'public');
        }

        // Convert string fields to arrays
        foreach (['technologies', 'features'] as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = array_map('trim', explode(',', $validated[$field]));
            } else {
                $validated[$field] = [];
            }
        }

        // Handle user roles and modules for web applications
        if ($request->type == 'webapp') {
            $validated['user_roles'] = $request->user_roles ? explode(',', $request->user_roles) : [];
            $validated['modules'] = $request->modules ? explode(',', $request->modules) : [];
        }

        Portfolio::create($validated);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Project added successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $constants = [
            'types' => PortfolioConstants::PROJECT_TYPES,
            'subTypes' => PortfolioConstants::SUB_TYPES,
            'statuses' => PortfolioConstants::PROJECT_STATUS,
            'confidentialityLevels' => PortfolioConstants::CONFIDENTIALITY_LEVELS,
            'accessTypes' => PortfolioConstants::ACCESS_TYPES,
            'complexityLevels' => PortfolioConstants::COMPLEXITY_LEVELS,
        ];

        return view('admin.portfolio.edit', [
            'project' => $portfolio,
            'constants' => $constants
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:website,webapp,software,document,presentation',
            'sub_type' => 'required|string|max:255',
            'description' => 'required',
            'client_name' => 'nullable|max:255',
            'before_image' => 'nullable|image|max:2048',
            'after_image' => $request->type == 'website' ? 'required|image|max:2048' : 'nullable|image|max:2048',
            'results' => 'nullable',
            'technologies' => 'nullable|string',
            'features' => 'nullable|string',
            'project_status' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'complexity_level' => 'nullable|integer|min:1|max:5',
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'access_type' => $request->type == 'webapp' ? 'required|string' : 'nullable|string',
            'user_base' => 'nullable|integer',
            'sample_file' => $request->type == 'document' || $request->type == 'presentation'
                ? 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240'
                : 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'formatting_style' => 'nullable|string',
            'number_of_pages' => 'nullable|integer',
            'document_type' => 'nullable|string',
            'confidentiality_level' => 'nullable|string',
            'client_testimonial' => 'nullable|string',
            'client_position' => 'nullable|string',
            'testimonial_date' => 'nullable|date',
            'is_featured' => 'boolean'
        ]);

        // Handle image uploads
        if ($request->hasFile('before_image')) {
            $this->deleteImage($portfolio->before_image);
            $validated['before_image'] = $this->storeImage(
                $request->file('before_image'),
                'portfolio/before'
            );
        }

        if ($request->hasFile('after_image')) {
            $this->deleteImage($portfolio->after_image);
            $validated['after_image'] = $this->storeImage(
                $request->file('after_image'),
                'portfolio/after'
            );
        }

        // Handle sample file
        if ($request->hasFile('sample_file')) {
            if ($portfolio->sample_file) {
                Storage::disk('public')->delete($portfolio->sample_file);
            }
            $validated['sample_file'] = $request->file('sample_file')
                ->store('portfolio/samples', 'public');
        }

        // Convert string fields to arrays (same as store method)
        foreach (['technologies', 'features'] as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = array_map('trim', explode(',', $validated[$field]));
            } else {
                $validated[$field] = [];
            }
        }

        // Handle web application specific fields
        if ($request->type == 'webapp') {
            $validated['user_roles'] = $request->user_roles ? explode(',', $request->user_roles) : [];
            $validated['modules'] = $request->modules ? explode(',', $request->modules) : [];
        }

        $portfolio->update($validated);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete all associated files
        $filesToDelete = [
            $portfolio->before_image,
            $portfolio->after_image,
            $portfolio->sample_file
        ];

        foreach ($filesToDelete as $file) {
            if ($file) {
                Storage::disk('public')->delete($file);
            }
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Project deleted successfully.');
    }

    // Public view methods
    public function show(Portfolio $portfolio)
    {
        return view('portfolio.show', compact('portfolio'));
    }

    public function publicIndex()
    {
        $featured = Portfolio::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $portfolios = Portfolio::latest()->paginate(9);

        // Add debug info
        Log::info('Portfolio Data:', [
            'featured_count' => $featured->count(),
            'portfolios_count' => $portfolios->count(),
            'sample_portfolio' => $portfolios->first() ? [
                'id' => $portfolios->first()->id,
                'title' => $portfolios->first()->title,
                'type' => $portfolios->first()->type,
                'technologies' => $portfolios->first()->technologies,
                'image_path' => $portfolios->first()->after_image,
                'storage_path' => Storage::path('public'),
                'image_url' => Storage::url($portfolios->first()->after_image),
            ] : null
        ]);

        return view('portfolio.index', compact('featured', 'portfolios'));
    }
}
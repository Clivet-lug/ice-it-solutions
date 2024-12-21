<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:website,software,document,presentation',
            'description' => 'required',
            'client_name' => 'nullable|max:255',
            'before_image' => 'nullable|image|max:2048',
            'after_image' => 'required|image|max:2048',
            'results' => 'nullable',
            'technologies' => 'nullable|string',
            'is_featured' => 'boolean'
        ]);

        // Handle image uploads
        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $request->file('before_image')->store('portfolio', 'public');
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $request->file('after_image')->store('portfolio', 'public');
        }

        // Convert technologies string to array
        if (!empty($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        } else {
            $validated['technologies'] = [];
        }

        Portfolio::create($validated);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Project added successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', ['project' => $portfolio]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:website,software,document,presentation',
            'description' => 'required',
            'client_name' => 'nullable|max:255',
            'before_image' => 'nullable|image|max:2048',
            'after_image' => 'nullable|image|max:2048',
            'results' => 'nullable',
            'technologies' => 'nullable|string',
            'is_featured' => 'boolean'
        ]);

        // Handle image uploads
        if ($request->hasFile('before_image')) {
            // Delete old image if exists
            if ($portfolio->before_image) {
                Storage::disk('public')->delete($portfolio->before_image);
            }
            $validated['before_image'] = $request->file('before_image')->store('portfolio', 'public');
        }

        if ($request->hasFile('after_image')) {
            // Delete old image if exists
            if ($portfolio->after_image) {
                Storage::disk('public')->delete($portfolio->after_image);
            }
            $validated['after_image'] = $request->file('after_image')->store('portfolio', 'public');
        }

        // Convert technologies string to array
        if (!empty($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        } else {
            $validated['technologies'] = [];
        }

        $portfolio->update($validated);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete associated images
        if ($portfolio->before_image) {
            Storage::disk('public')->delete($portfolio->before_image);
        }
        if ($portfolio->after_image) {
            Storage::disk('public')->delete($portfolio->after_image);
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Project deleted successfully.');
    }

    // Public view methods
    public function show(Portfolio $portfolio)
    {
        return view('portfolio.show', compact('portfolio'),['project' => $portfolio]);
    }

    public function publicIndex()
    {
        $featured = Portfolio::where('is_featured', true)->take(3)->get();
        $portfolios = Portfolio::when(request('type'), function ($query, $type) {
            return $query->where('type', $type);
        })
            ->latest()
            ->paginate(9);

        return view('portfolio.index', compact('featured', 'portfolios'));
    }
}

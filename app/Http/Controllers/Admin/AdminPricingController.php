<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPricingController extends Controller
{
    public function index()
    {
        $pricings = Pricing::all();
        return view('admin.pricing.index', compact('pricings'));
    }

    public function create()
    {
        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:website,document,presentation',
            'price' => 'required|numeric|min:0',
            'features' => 'required|array',
            'button_text' => 'required|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['features'] = json_encode($validated['features']);
        Pricing::create($validated);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan created successfully');
    }

    public function edit(Pricing $pricing)
    {
        return view('admin.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, Pricing $pricing)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:website,document,presentation',
            'price' => 'required|numeric|min:0',
            'features' => 'required|array',
            'button_text' => 'required|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['features'] = json_encode($validated['features']);
        $pricing->update($validated);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan updated successfully');
    }

    public function destroy(Pricing $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan deleted successfully');
    }
}

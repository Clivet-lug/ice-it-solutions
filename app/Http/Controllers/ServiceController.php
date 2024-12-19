<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of services
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all services from the database
        $services = Service::latest()->get();

        // Return view with services data
        return view('services.index', compact('services'));
    }

    /**
     * Show form for creating a new service
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created service
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        // Handle file upload if an icon was provided
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('services', 'public');
            $validated['icon'] = $iconPath;
        }

        // Create the service
        Service::create($validated);

        // Redirect with success message
        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service
     *
     * @param Service $service
     * @return \Illuminate\View\View
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show form for editing the specified service
     *
     * @param Service $service
     * @return \Illuminate\View\View
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified service
     *
     * @param Request $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Service $service)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        // Handle file upload if a new icon was provided
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
            }

            // Store new icon
            $iconPath = $request->file('icon')->store('services', 'public');
            $validated['icon'] = $iconPath;
        }

        // Update the service
        $service->update($validated);

        // Redirect with success message
        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service
     *
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service)
    {
        // Delete the service icon if it exists
        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }

        // Delete the service
        $service->delete();

        // Redirect with success message
        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
}

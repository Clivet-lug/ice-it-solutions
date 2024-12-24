<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        // Add search functionality
        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('short_description', 'like', "%{$search}%");
        }

        // Add filters
        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        $services = $query->latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:services',
                'short_description' => 'required|string|max:500',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'features' => 'required|array|min:1',
                'features.*' => 'required|string|max:255',
                'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
                'is_active' => 'boolean'
            ]);

            $validated['slug'] = $this->generateUniqueSlug($validated['name']);
            $validated['features'] = json_encode(array_values($validated['features']));

            if ($request->hasFile('image')) {
                $validated['image'] = $this->handleImageUpload($request->file('image'));
            }

            Service::create($validated);
            DB::commit();

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating service: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Failed to create service. Please try again.');
        }
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:services,name,' . $service->id,
                'short_description' => 'required|string|max:500',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'features' => 'required|array|min:1',
                'features.*' => 'required|string|max:255',
                'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
                'is_active' => 'boolean'
            ]);

            if ($service->name !== $validated['name']) {
                $validated['slug'] = $this->generateUniqueSlug($validated['name']);
            }

            $validated['features'] = json_encode(array_values($validated['features']));

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($service->image) {
                    Storage::disk('public')->delete($service->image);
                }
                $validated['image'] = $this->handleImageUpload($request->file('image'));
            }

            $service->update($validated);
            DB::commit();

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating service: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Failed to update service. Please try again.');
        }
    }

    public function destroy(Service $service)
    {
        try {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $service->delete();
            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting service: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete service. Please try again.');
        }
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = 2;

        while (Service::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    private function handleImageUpload($image)
    {
        $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
        return $image->storeAs('services', $filename, 'public');
    }
}

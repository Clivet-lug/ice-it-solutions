<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function request(Service $service)
    {
        return view('services.request', compact('service'));
    }

    public function submitRequest(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'description' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240'
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments');
                $attachments[] = $path;
            }
        }

        // Create service request record
        $serviceRequest = ServiceRequest::create([
            'service_id' => $validated['service_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'description' => $validated['description'],
            'attachments' => $attachments ?? null
        ]);

        return redirect()
            ->route('services.show', $request->service_id)
            ->with('success', 'Your request has been submitted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        // Get active services with pagination
        $services = Service::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        // Check if service is active
        if (!$service->is_active) {
            abort(404);
        }

        return view('services.show', compact('service'));
    }

    public function request(Service $service)
    {
        // Check if service is active
        if (!$service->is_active) {
            abort(404);
        }

        return view('services.request', compact('service'));
    }

    public function submitRequest(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'description' => 'required|string',
            'attachments.*' => [
                'nullable',
                'file',
                'max:10240', // 10MB max
                'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png' // Allowed file types
            ]
        ]);

        try {
            DB::beginTransaction();

            $attachments = [];
            // Handle file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    // Generate unique filename
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    // Store in the public disk
                    $path = $file->storeAs('attachments', $filename, 'public');
                    $attachments[] = [
                        'path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType()
                    ];
                }
            }

            // Create service request record
            $serviceRequest = ServiceRequest::create([
                'service_id' => $validated['service_id'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'description' => $validated['description'],
                'attachments' => $attachments,
                'status' => 'pending'
            ]);

            DB::commit();

            // Send notification email (you'll need to implement this)
            // event(new ServiceRequestSubmitted($serviceRequest));

            return redirect()
                ->route('services.show', $request->service_id)
                ->with('success', 'Your request has been submitted successfully. We will contact you soon.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded files if any
            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }

            return back()
                ->withInput()
                ->with('error', 'There was an error submitting your request. Please try again.');
        }
    }
}

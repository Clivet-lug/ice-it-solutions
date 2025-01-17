<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function index()
    {
        try {
            Log::info('Attempting to load services index page');

            // Explicitly check if Service model exists
            if (!class_exists('App\Models\Service')) {
                Log::error('Service model not found');
                throw new \Exception('Service model not found');
            }

            // Get active services with pagination
            $services = Service::where('is_active', true)
                ->select('id', 'name', 'short_description', 'price', 'features', 'image')
                ->orderBy('created_at', 'desc')
                ->paginate(9);

            Log::info('Services loaded successfully', [
                'count' => $services->count(),
                'total' => $services->total()
            ]);

            // Check if features are properly formatted
            $services->each(function ($service) {
                if (!is_array($service->features)) {
                    $service->features = json_decode($service->features, true) ?? [];
                }
            });

            return view('services.index', compact('services'));
        } catch (\Exception $e) {
            Log::error('Error in ServiceController@index: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Since APP_DEBUG is true, this will show detailed error
            throw $e;
        }
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

            $service = Service::findOrFail($validated['service_id']);

            DB::commit();

            // Send notification email (you'll need to implement this)
            // event(new ServiceRequestSubmitted($serviceRequest));

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your request has been submitted successfully. We will contact you soon.',
                    'redirect' => route('services.show', $service)
                ]);
            }

            return redirect()
                ->route('services.show', $service)
                ->with('success', 'Your request has been submitted successfully. We will contact you soon.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded files if any
            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error submitting your request. Please try again.'
                ], 422);
            }

            return back()
                ->withInput()
                ->with('error', 'There was an error submitting your request. Please try again.');
        }
    }
}
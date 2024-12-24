<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceRequest::with('service');

        // Add search functionality
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('service', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Add status filter
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Add date range filter
        if ($startDate = $request->get('start_date')) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate = $request->get('end_date')) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $requests = $query->latest()->paginate(10);

        // Get statistics
        $statistics = [
            'total' => ServiceRequest::count(),
            'pending' => ServiceRequest::where('status', 'pending')->count(),
            'processing' => ServiceRequest::where('status', 'processing')->count(),
            'completed' => ServiceRequest::where('status', 'completed')->count()
        ];

        return view('admin.requests.index', compact('requests', 'statistics'));
    }

    public function show(ServiceRequest $request)
    {
        $request->load('service');
        return view('admin.requests.show', compact('request'));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        // try {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        // Record the previous status
        $oldStatus = $serviceRequest->status;

        $serviceRequest->update($validated);

        // Log status change
        // if ($oldStatus !== $validated['status']) {
        //     activity()
        //         ->performedOn($serviceRequest)
        //         ->withProperties([
        //             'old_status' => $oldStatus,
        //             'new_status' => $validated['status']
        //         ])
        //         ->log('status_changed');
        // }

        return redirect()
            ->back()
            ->with('success', 'Request updated successfully');
        // } catch (\Exception $e) {
        //     Log::error('Error updating service request: ' . $e->getMessage());
        //     return back()
        //         ->withInput()
        //         ->with('error', 'Failed to update request. Please try again.');
        // }
    }

    public function destroy(ServiceRequest $request)
    {
        try {
            // Delete attached files if any
            if (!empty($request->attachments)) {
                foreach ($request->attachments as $attachment) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }

            $request->delete();
            return redirect()
                ->route('admin.requests.index')
                ->with('success', 'Request deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting service request: ' . $e->getMessage());
            return back()
                ->with('error', 'Failed to delete request. Please try again.');
        }
    }

    public function downloadAttachment(ServiceRequest $request, $attachmentIndex)
    {
        try {
            // Check if attachment exists
            $attachments = $request->attachments;
            if (!is_array($attachments) || !isset($attachments[$attachmentIndex])) {
                return back()->with('error', 'Attachment not found.');
            }

            $attachment = $attachments[$attachmentIndex];

            // Verify path exists in attachment array
            if (!isset($attachment['path']) || !isset($attachment['original_name'])) {
                return back()->with('error', 'Invalid attachment data.');
            }

            $path = storage_path('app/public/' . $attachment['path']);

            // Check if file exists physically
            if (!file_exists($path)) {
                return back()->with('error', 'File not found on server.');
            }

            // Return file download response
            return response()->download($path, $attachment['original_name']);
        } catch (\Exception $e) {
            Log::error('Error downloading attachment: ' . $e->getMessage());
            return back()->with('error', 'Failed to download attachment. Error: ' . $e->getMessage());
        }
    }
}

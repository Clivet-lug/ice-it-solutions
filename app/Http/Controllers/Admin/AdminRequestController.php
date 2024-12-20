<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class AdminRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with('service')
            ->latest()
            ->paginate(10);

        return view('admin.requests.index', compact('requests'));
    }

    public function show(ServiceRequest $request)
    {
        return view('admin.requests.show', compact('request'));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed',
            'admin_notes' => 'nullable|string'
        ]);

        $serviceRequest->update($validated);

        return redirect()->back()->with('success', 'Request updated successfully');
    }

    public function destroy(ServiceRequest $request)
    {
        $request->delete();
        return redirect()->route('admin.requests.index')->with('success', 'Request deleted');
    }
}

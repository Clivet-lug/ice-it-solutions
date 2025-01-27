<?php

namespace App\Http\Controllers\Admin;

use App\Models\PricingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPricingRequestController extends Controller
{
    public function index()
    {
        $requests = PricingRequest::with('pricing')->latest()->paginate(10);
        return view('admin.pricing-requests.index', compact('requests'));
    }

    public function show(PricingRequest $request)
    {
        return view('admin.pricing-requests.show', compact('request'));
    }

    public function updateStatus(Request $request, PricingRequest $pricingRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        $pricingRequest->update($validated);

        return redirect()->back()->with('success', 'Request status updated successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Helpers\EmailHelper;
use Illuminate\Http\Request;
use App\Models\PricingRequest;

class PricingRequestController extends Controller
{
    public function create(Pricing $pricing)
    {
        return view('pricing.request', compact('pricing'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'pricing_id' => 'required|exists:pricings,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'description' => 'required|string',
                'requirements' => 'nullable|array'
            ]);

            $pricingRequest = PricingRequest::create($validated);

            // Send confirmation email
            EmailHelper::sendRequestConfirmation($pricingRequest, 'pricing');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your request has been submitted successfully!'
                ]);
            }

            return redirect()->route('pricing.index')
                ->with('success', 'Your request has been submitted successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while submitting your request.'
                ], 422);
            }

            return back()->withErrors(['error' => 'An error occurred while submitting your request.']);
        }
    }
}
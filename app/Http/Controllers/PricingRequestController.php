<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\PricingRequest;
use Illuminate\Http\Request;

class PricingRequestController extends Controller
{
    public function create(Pricing $pricing)
    {
        return view('pricing.request', compact('pricing'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pricing_id' => 'required|exists:pricings,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'description' => 'required|string',
            'requirements' => 'nullable|array'
        ]); 

        PricingRequest::create($validated);

        return redirect()->route('pricing.index')
            ->with('success', 'Your request has been submitted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $pricings = Pricing::where('is_active', true)->get();

        $counts = [
            'all' => $pricings->count(),
            'website' => $pricings->where('type', 'Website')->count(),
            'document' => $pricings->where('type', 'Document')->count(),
            'presentation' => $pricings->where('type', 'Presentation')->count(),
        ];

        return view('pricing.index', compact('pricings', 'counts'));
    }
}
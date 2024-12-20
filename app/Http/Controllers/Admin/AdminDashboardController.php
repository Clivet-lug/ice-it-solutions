<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'pending_requests' => ServiceRequest::where('status', 'pending')->count(),
            'total_requests' => ServiceRequest::count(),
        ];

        $recent_requests = ServiceRequest::with('service')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_requests'));
    }
}

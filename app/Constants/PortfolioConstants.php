<?php

namespace App\Constants;

class PortfolioConstants
{
    const PROJECT_TYPES = [
        'website' => 'Website',
        'webapp' => 'Web Application',
        'software' => 'Software Solution',
        'document' => 'Document Formatting',
        'presentation' => 'Presentation Design'
    ];

    const SUB_TYPES = [
        'website' => [
            'corporate' => 'Corporate Website',
            'ecommerce' => 'E-commerce',
            'portfolio' => 'Portfolio Website',
            'blog' => 'Blog/News Website',
            'landing' => 'Landing Page'
        ],
        'webapp' => [
            'erp' => 'ERP System',
            'crm' => 'CRM System',
            'management' => 'Management System',
            'booking' => 'Booking System',
            'other' => 'Other'
        ],
        'software' => [
            'desktop' => 'Desktop Application',
            'mobile' => 'Mobile Application',
            'api' => 'API/Integration',
            'extension' => 'Browser Extension'
        ],
        'document' => [
            'resume' => 'Resume/CV',
            'academic' => 'Academic Paper',
            'report' => 'Business Report',
            'proposal' => 'Proposal'
        ],
        'presentation' => [
            'business' => 'Business Presentation',
            'academic' => 'Academic Presentation',
            'pitch' => 'Pitch Deck',
            'training' => 'Training Material'
        ]
    ];

    const PROJECT_STATUS = [
        'live' => 'Live/Active',
        'maintenance' => 'Maintenance',
        'completed' => 'Completed',
        'beta' => 'Beta',
        'archived' => 'Archived'
    ];

    const CONFIDENTIALITY_LEVELS = [
        'public' => 'Public',
        'partial' => 'Partial - Limited Details',
        'private' => 'Private - Minimal Details'
    ];

    const ACCESS_TYPES = [
        'public' => 'Public Access',
        'private' => 'Private Access',
        'enterprise' => 'Enterprise',
        'internal' => 'Internal System'
    ];

    const COMPLEXITY_LEVELS = [
        1 => 'Simple',
        2 => 'Basic',
        3 => 'Intermediate',
        4 => 'Complex',
        5 => 'Highly Complex'
    ];
}
<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Website',
                'type' => 'website',
                'price' => 999.99,
                'features' => json_encode([
                    '5 Pages',
                    'Responsive Design',
                    'Contact Form',
                    'Basic SEO',
                    '1 Month Support'
                ]),
                'button_text' => 'Get Started',
                'is_featured' => false,
                'is_active' => true
            ],
            [
                'name' => 'Professional Website',
                'type' => 'website',
                'price' => 1999.99,
                'features' => json_encode([
                    'Up to 10 Pages',
                    'Responsive Design',
                    'Contact Form',
                    'Advanced SEO',
                    'Blog Section',
                    'Social Media Integration',
                    '3 Months Support'
                ]),
                'button_text' => 'Get Started',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'name' => 'Basic Document',
                'type' => 'document',
                'price' => 49.99,
                'features' => json_encode([
                    'Basic Formatting',
                    '24hr Delivery',
                    '1 Revision'
                ]),
                'button_text' => 'Order Now',
                'is_featured' => false,
                'is_active' => true
            ]
        ];

        foreach ($plans as $plan) {
            Pricing::create($plan);
        }
    }
}

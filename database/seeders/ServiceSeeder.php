<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'Document formatting',
                'slug' => 'document-formatting',
                'short_description' => 'Have any document typed out in a format of your choosing.',
                'description' => 'Full formatting service for all document types',
                'price' => 50.00,
                'features' => json_encode(['Word documents', 'PDFs', 'Hand-written notes']),
                'is_active' => true
            ],
            [
                'name' => 'Present like a Pro',
                'slug' => 'presentation-design',
                'short_description' => 'Have professionally redesigned Presentations designed to capture your audience.',
                'description' => 'Professional presentation design service',
                'price' => 100.00,
                'features' => json_encode(['PowerPoint', 'Design consultation', 'Revisions']),
                'is_active' => true
            ],
            [
                'name' => 'Create a Website',
                'slug' => 'website-creation',
                'short_description' => 'Work with a UI/UX designer and have a beautiful website tailor made.',
                'description' => 'Custom website development service',
                'price' => 500.00,
                'features' => json_encode(['Custom design', 'Responsive layout', 'SEO optimization']),
                'is_active' => true
            ]
        ]);
    }
}

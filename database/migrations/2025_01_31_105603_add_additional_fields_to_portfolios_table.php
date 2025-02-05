<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToPortfoliosTable extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // Common fields
            $table->string('sub_type')->nullable()->after('type');  // e.g., ERP, CRM, E-commerce
            $table->json('features')->nullable();  // Store list of features
            $table->json('technologies_used')->nullable(); // More detailed than current technologies
            $table->string('project_status')->nullable(); // Live, Maintenance, Beta, etc.
            $table->date('completion_date')->nullable();
            $table->integer('complexity_level')->nullable(); // 1-5 scale
            $table->text('challenges')->nullable();
            $table->text('solutions')->nullable();

            // Website specific
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();

            // Web Application specific
            $table->string('access_type')->nullable(); // Private, Enterprise, Internal
            $table->json('user_roles')->nullable(); // Types of users who can access
            $table->integer('user_base')->nullable(); // Number of users if shareable
            $table->json('modules')->nullable(); // System modules/components

            // Document/Presentation specific
            $table->string('sample_file')->nullable(); // PDF/PPTX file path
            $table->string('formatting_style')->nullable(); // Guidelines or style used
            $table->integer('number_of_pages')->nullable();
            $table->string('document_type')->nullable(); // Resume, Report, Academic, etc.

            // Additional metadata
            $table->string('confidentiality_level')->nullable(); // Public, Partial, Private
            $table->json('meta_data')->nullable(); // For any additional type-specific data

            // Optional: Add testimonial fields if not in separate table
            $table->text('client_testimonial')->nullable();
            $table->string('client_position')->nullable(); // Position of the person giving testimonial
            $table->date('testimonial_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'sub_type',
                'features',
                'technologies_used',
                'project_status',
                'completion_date',
                'complexity_level',
                'challenges',
                'solutions',
                'live_url',
                'github_url',
                'access_type',
                'user_roles',
                'user_base',
                'modules',
                'sample_file',
                'formatting_style',
                'number_of_pages',
                'document_type',
                'confidentiality_level',
                'meta_data',
                'client_testimonial',
                'client_position',
                'testimonial_date'
            ]);
        });
    }
}

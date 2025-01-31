<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugAndSoftDeletesToPortfoliosTable extends Migration
{
    public function up()
    {
        // Step 1: Add nullable slug column and soft deletes
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->softDeletes();
        });

        // Step 2: Generate slugs for existing records
        DB::table('portfolios')->orderBy('id')->each(function ($portfolio) {
            $baseSlug = Str::slug($portfolio->title);
            $slug = $baseSlug;
            $count = 1;

            // Check for duplicate slugs
            while (DB::table('portfolios')
                ->where('slug', $slug)
                ->where('id', '!=', $portfolio->id)
                ->exists()
            ) {
                $slug = $baseSlug . '-' . $count++;
            }

            DB::table('portfolios')
                ->where('id', $portfolio->id)
                ->update(['slug' => $slug]);
        });

        // Step 3: Make slug column non-nullable
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropSoftDeletes();
        });
    }
}
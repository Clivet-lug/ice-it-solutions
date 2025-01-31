<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexToPortfoliosSlug extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });
    }
}
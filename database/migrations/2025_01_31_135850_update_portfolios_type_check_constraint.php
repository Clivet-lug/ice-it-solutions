<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePortfoliosTypeCheckConstraint extends Migration
{
    public function up()
    {
        // First, let's drop the old constraint
        DB::statement('ALTER TABLE portfolios DROP CONSTRAINT IF EXISTS portfolios_type_check');

        // Then add the new constraint with ALL valid types
        DB::statement("ALTER TABLE portfolios ADD CONSTRAINT portfolios_type_check CHECK (type IN ('website', 'webapp', 'software', 'document', 'presentation'))");
    }

    public function down()
    {
        // Remove the new constraint
        DB::statement('ALTER TABLE portfolios DROP CONSTRAINT IF EXISTS portfolios_type_check');

        // Add back the original constraint
        DB::statement("ALTER TABLE portfolios ADD CONSTRAINT portfolios_type_check CHECK (type IN ('website', 'software', 'document', 'presentation'))");
    }
}
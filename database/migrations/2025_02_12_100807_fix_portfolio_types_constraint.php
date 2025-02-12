<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixPortfolioTypesConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, drop the existing constraint
        DB::statement('ALTER TABLE portfolios DROP CONSTRAINT IF EXISTS portfolios_type_check');

        // Then add the constraint with all types
        DB::statement("ALTER TABLE portfolios ADD CONSTRAINT portfolios_type_check CHECK (type IN ('website', 'webapp', 'software', 'document', 'presentation'))");

        // Also update the column type definition
        DB::statement("ALTER TABLE portfolios ALTER COLUMN type TYPE VARCHAR(255)"); // First make it varchar
        DB::statement("ALTER TABLE portfolios ADD CONSTRAINT portfolios_type_enum CHECK (type IN ('website', 'webapp', 'software', 'document', 'presentation'))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the new constraints
        DB::statement('ALTER TABLE portfolios DROP CONSTRAINT IF EXISTS portfolios_type_check');
        DB::statement('ALTER TABLE portfolios DROP CONSTRAINT IF EXISTS portfolios_type_enum');

        // Add back original enum
        DB::statement("ALTER TABLE portfolios ALTER COLUMN type TYPE VARCHAR(255)");
        DB::statement("ALTER TABLE portfolios ADD CONSTRAINT portfolios_type_check CHECK (type IN ('website', 'software', 'document', 'presentation'))");
    }
}

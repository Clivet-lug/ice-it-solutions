<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('pricing_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->text('description');
            $table->json('requirements')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricing_requests');
    }
}
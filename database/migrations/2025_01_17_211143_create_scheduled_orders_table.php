<?php

use App\Models\Campaign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scheduled_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Campaign::class);

            $table->unsignedInteger('service_id');
            $table->string('link');
            $table->unsignedInteger('quantity');
            $table->dateTime('run_at');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('tg_top_order_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_orders');
    }
};

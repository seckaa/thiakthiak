<?php

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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('tips')->default('2.00');
            $table->string('sub_total')->nullable();
            $table->string('tax')->nullable();
            $table->string('is_collection');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('tips');
            $table->dropColumn('is_collection');
            $table->dropColumn('tax');
            $table->dropColumn('sub_total');
            // $table->dropColumn('driver_id');
        });
    }
};

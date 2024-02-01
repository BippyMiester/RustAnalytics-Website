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
        Schema::table('placed_deployables', function (Blueprint $table) {
            $table->string('x')->nullable();
            $table->string('y')->nullable();
            $table->string('z')->nullable();
            $table->string('grid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('placed_deployables', function (Blueprint $table) {
            $table->dropColumn('x');
            $table->dropColumn('y');
            $table->dropColumn('z');
            $table->dropColumn('grid');
        });
    }
};

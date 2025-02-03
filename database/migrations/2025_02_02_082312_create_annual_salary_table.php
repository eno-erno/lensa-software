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
        Schema::create('annual_salary', function (Blueprint $table) {
            $table->id();
            $table->string('noreg')->unique();
            $table->string('employee_id');
            $table->string('register_date');
            $table->string('adjustment_option');
            $table->double('amount', 15, 4);
            $table->double('percentage', 12, 4);
            $table->double('new_gapok', 15, 4);
            $table->double('adjustment', 15, 4);
            $table->double('pctg_adjustment', 12, 4);
            $table->enum('flag_status', ['register', 'processed', 'approved']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_salary');
    }
};

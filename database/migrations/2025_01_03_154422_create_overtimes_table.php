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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->foreignId('department_id')->constrained('departments');
            $table->dateTime('begin');
            $table->dateTime('end');
            $table->string('description');
            $table->string('shift')->nullable();
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected'])->default('pending');

            $table->boolean('bus')->default(false);
            $table->integer('current_manager')->default(1);


            $table->timestamps();
        });

        Schema::create('overtime_approval_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('overtime_id')->constrained('overtimes');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('action', ['approved', 'rejected'])->default('approved');
            $table->string('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
        Schema::dropIfExists('overtime_approval_history');
    }
};

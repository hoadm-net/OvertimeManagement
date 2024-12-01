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
            $table->foreignId('department_id')->constrained('departments');
            $table->dateTime('begin');
            $table->dateTime('end');
            $table->string('description');

            $table->enum('status', ['pending', 'manager_approved', 'bod_approved', 'denied'])->default('pending');

            $table->foreignId('manager_id')->nullable();
            $table->string('manager_note')->nullable();
            $table->dateTime('manager_approved_at')->nullable();

            $table->foreignId('bod_id')->nullable();
            $table->string('bod_note')->nullable();
            $table->dateTime('bod_approved_at')->nullable();

            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bod_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};

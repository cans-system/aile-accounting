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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('master', ['writable', 'approveonly', 'readonly', 'disabled']);
            $table->enum('package', ['writable', 'approveonly', 'readonly', 'disabled']);
            $table->enum('settlement', ['writable', 'approveonly', 'readonly', 'disabled']);
            $table->enum('users', ['writable', 'approveonly', 'readonly', 'disabled']);
            $table->enum('closing', ['writable', 'approveonly', 'readonly', 'disabled']);
            $table->enum('carryover', ['writable', 'approveonly', 'readonly', 'disabled']);
            $table->foreignId('client_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

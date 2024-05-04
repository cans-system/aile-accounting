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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_business_id')->constrained('company_business');
            $table->foreignId('target_company_business_id')->constrained('company_business');
            $table->foreignId('account_id')->constrained();
            $table->integer('dr_amount');
            $table->integer('cr_amount');
            $table->string('note');
            $table->string('file_name')->nullable();
            $table->foreignId('journal_subcategory_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};

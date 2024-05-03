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
            $table->foreignId('company_id')->constrained(); // ここらの構造どうするか考える 5/3
            $table->foreignId('business_id')->constrained();
            $table->foreignId('target_company_id')->constrained('companies');
            $table->foreignId('target_business_id')->constrained('businesses');
            $table->foreignId('account_id')->constrained();
            $table->integer('dr_amount');
            $table->integer('cr_amount');
            $table->string('note');
            $table->string('file_name');
            $table->foreignId('journal_category_id')->constrained();
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

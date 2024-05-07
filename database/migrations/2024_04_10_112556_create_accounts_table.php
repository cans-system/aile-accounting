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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->char('code', 7);
            $table->string('title_en');
            $table->unsignedTinyInteger('detail_summary');
            $table->string('statement');
            $table->foreignId('category_id')->constrained();
            $table->unsignedTinyInteger('dr_cr');
            $table->foreignId('fcta_account_id')->nullable();
            $table->foreignId('carryover_account_id')->nullable();
            $table->foreignId('year_disclosed_account_list_id')->constrained('disclosed_account_lists');
            $table->foreignId('quarter_disclosed_account_list_id')->constrained('disclosed_account_lists');
            $table->unsignedTinyInteger('conversion')->nullable();
            $table->boolean('enabled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

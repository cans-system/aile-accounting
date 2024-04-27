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
            $table->string('title_en');
            $table->enum('detail_summary', ['明細科目', '集計科目']);
            $table->unsignedtinyInteger('statement');
            $table->foreignId('category_id')->constrained();
            $table->enum('dr_cr', ['借方', '貸方']);
            $table->foreignId('year_disclosed_account_list_id')->constrained('disclosed_account_lists');
            $table->foreignId('quarter_disclosed_account_list_id')->constrained('disclosed_account_lists');
            $table->enum('conversion', ['期末日レート', '期中平均レート']);
            $table->foreignId('fctr_account_id')->nullable()->constrained('accounts');
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

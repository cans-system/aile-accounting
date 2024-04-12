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
            $table->enum('statement', ['貸借対照表']);
            $table->foreignId('category_id')->constrained();
            $table->enum('dr_cr', ['借方', '貸方']);
            $table->enum('conversion', ['期末日レート', '期中平均レート']);
            $table->enum('fctr', ['為替換算調整勘定-換算調整']);
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

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
        Schema::create('inspection_extract_items', function (Blueprint $table) {
            $table->id('extractItemId');
            $table->unsignedBigInteger('extractId')->nullable();
            $table->text('description')->nullable();
            $table->string('year')->nullable();
            $table->string('countryOfOrigin')->nullable();
            $table->string('costFob')->nullable();
            $table->string('costCif')->nullable();
            $table->string('currency')->nullable();
            $table->string('exchangeRate')->nullable();
            $table->text('nairaValue')->nullable();
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->string('capacity')->nullable();
            $table->text('source')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('extractId')->references('extractId')->on('inspection_extract')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_extract_items');
    }
};



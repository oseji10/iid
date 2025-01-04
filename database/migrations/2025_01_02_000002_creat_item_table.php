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
        Schema::create('items', function (Blueprint $table) {
            $table->id('itemId');
            $table->unsignedBigInteger('categoryId');
            $table->string('itemCode')->nullable();
            $table->text('description')->nullable();
            $table->string('year')->nullable();
            $table->string('value')->nullable();
            $table->string('brand')->nullable();
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->text('source')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoryId')->references('categoryId')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};



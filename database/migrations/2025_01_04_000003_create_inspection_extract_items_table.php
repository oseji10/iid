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
        Schema::create('inspection_extract', function (Blueprint $table) {
            $table->id('extractId');
            
            $table->string('companyName')->nullable();
            $table->text('fileNumber')->nullable();
            $table->text('natureOfBusiness')->nullable();
            $table->unsignedBigInteger('officerId')->nullable();
           
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('officerId')->references('officerId')->on('officers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_extract');
    }
};



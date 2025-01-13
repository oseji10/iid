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
        Schema::create('officers', function (Blueprint $table) {
            $table->id('officerId');
            
            $table->string('officerName')->nullable();
            $table->text('designation')->nullable();
            $table->unsignedBigInteger('departmentId')->nullable();
            $table->string('signature')->nullable();
           
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('departmentId')->references('departmentId')->on('departments')->onDelete('cascade');

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



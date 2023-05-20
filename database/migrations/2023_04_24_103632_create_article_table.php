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
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->string('code_article')->primary();
            $table->string('descriptif');
            $table->longText('description');
            $table->string('code_famille');
            $table->string('unite');
            $table->double('pmp');
            $table->string('categorie');
            $table->string('nature');
            $table->string('criticite');
            $table->string('position');
            $table->string('image');
            $table->string('barcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};

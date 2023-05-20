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
        Schema::create('ot', function (Blueprint $table) {
            $table->id();
            $table->string('num_ot');
            $table->string('code_article');
            $table->longText('description');
            $table->string('type');
            $table->string('source');
            $table->string('destination');
            $table->string('service');
            $table->string('personne');
            $table->string('num_equipement');
            $table->longText('justification');
            $table->integer('qte_sortie');
            $table->integer('qte_allouee_local');
            $table->integer('qte_allouee_fictif');
            $table->string('allouer');
            $table->string('statut');
            $table->date('date_sortie');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ot');
    }
};

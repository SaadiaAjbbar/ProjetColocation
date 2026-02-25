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
        Schema::create('depenses', function (Blueprint $table) {
            $table              ->id();
            $table->float('montant');
            $table->string('description');
            $table->date('date_depense');

// One-to-One relation with category
            $table->foreignId('categorie_id')
                    ->unique()                // important: unique → One-to-One
                    ->constrained('categories')
                    ->onDelete('cascade');

            $table->foreignId('adhesion_id')
                    ->constrained()
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};

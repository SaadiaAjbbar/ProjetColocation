<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->foreignId('colocation_id')
                  ->nullable() // important ila kayn data qdima
                  ->after('name')
                  ->constrained()
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->dropForeign(['colocation_id']);
            $table->dropColumn('colocation_id');

        });
    }
};

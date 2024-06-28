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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger("type_id")->nullable()->after("title");
            $table->foreign("type_id")->references("id")->on("type"); // Assicurati che sia 'type'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['type_id']); // Usato array per specificare la colonna
            $table->dropColumn("type_id");
        });
    }
};

<?php

use App\Models\Equipe;
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

        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('ville', 75);
            $table->string('categorie', 75);
            $table->string('championnat', 75);
            $table->timestamps();
            $table->softDeletes();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};

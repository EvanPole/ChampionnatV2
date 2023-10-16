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
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 100);
            $table->string('tel', 30);
            $table->unsignedBigInteger('sexe');
            $table->foreignIdFor(Equipe::class);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Equipe::class, 'domicile');
            $table->foreignIdFor(Equipe::class, 'visiteur');
            $table->integer('but_domicile')->nullable();
            $table->integer('but_visiteur')->nullable();
            $table->dateTime('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
        Schema::dropIfExists('matches');
    }
};

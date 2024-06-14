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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('api_id');
            $table->string('api_home_team_id');
            $table->string('api_visitor_team_id');
            $table->date('date');
            $table->integer('season');
            $table->string('status');
            $table->integer('period');
            $table->string('time');
            $table->boolean('postseason');
            $table->integer('home_team_score');
            $table->integer('visitor_team_score');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

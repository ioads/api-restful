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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('api_id');
            $table->string('api_team_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('position');
            $table->string('height');
            $table->string('weight');
            $table->string('jersey_number');
            $table->string('college');
            $table->string('country');
            $table->integer('draft_year')->nullable();
            $table->integer('draft_round')->nullable();
            $table->integer('draft_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};

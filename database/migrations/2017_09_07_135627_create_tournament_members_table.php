<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tournament_id');
            $table->integer('team_id')->nullable();
            $table->integer('player_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unique(['team_id', 'player_id']);

            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_members');
    }
}

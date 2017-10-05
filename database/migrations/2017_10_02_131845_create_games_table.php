<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->nullable();
            $table->integer('sport_id');
            $table->integer('tournament_id')->nullable();
            $table->enum('gameable_type', ['teams', 'players']);
            $table->integer('member_one');
            $table->integer('member_two');
            $table->string('score_one')->nullable();
            $table->string('score_two')->nullable();
            $table->enum('result', ['member_one_win', 'member_two_win', 'draw'])->nullable();
            $table->dateTime('date');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}

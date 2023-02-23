<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavoritesGamesTable extends Migration
{
    public function up()
    {
        Schema::create(\Modules\User\Entities\UserFavoritesGame::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id');

            //
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');

            $table->foreign('user_id')->references('id')->on(\Modules\User\Entities\User::TABLE)->onDelete('CASCADE');
            $table->foreign('game_id')->references('id')->on(\Modules\Game\Models\Game::TABLE)->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\User\Entities\UserFavoritesGame::TABLE);
    }
}

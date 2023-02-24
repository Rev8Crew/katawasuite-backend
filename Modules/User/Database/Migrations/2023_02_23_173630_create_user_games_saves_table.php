<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(\Modules\User\Entities\UserGameSave::TABLE, function (Blueprint $table) {
            $table->id();
            $table->longText('data')->nullable();

            $table->integer('slot')->index()->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');

            $table->foreign('user_id')->references('id')->on(\Modules\User\Entities\User::TABLE)->onDelete('CASCADE');
            $table->foreign('game_id')->references('id')->on(\Modules\Game\Entities\Game::TABLE)->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\User\Entities\UserGameSave::TABLE);
    }
};

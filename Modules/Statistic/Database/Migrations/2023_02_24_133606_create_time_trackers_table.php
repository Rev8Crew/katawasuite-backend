<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(\Modules\Statistic\Models\TimeTracker::TABLE, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');

            $table->unsignedInteger('start')->default(0);
            $table->unsignedInteger('end')->default(0);

            $table->foreign('user_id')->references('id')->on(\Modules\User\Entities\User::TABLE)->onDelete('CASCADE');
            $table->foreign('game_id')->references('id')->on(\Modules\Game\Entities\Game::TABLE)->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\Statistic\Models\TimeTracker::TABLE);
    }
};

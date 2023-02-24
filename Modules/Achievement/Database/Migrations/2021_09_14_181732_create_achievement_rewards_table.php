<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(\Modules\Achievement\Models\AchievementReward::TABLE, function (Blueprint $table) {
            $table->id();

            /** Тип награды @see \Modules\Achievement\Enums\RewardTypeEnum */
            $table->string('type')->index();
            $table->string('value')->nullable();

            $table->integer('is_active');

            $table->unsignedBigInteger('achievement_id');

            $table->foreign('achievement_id')
                ->references('id')
                ->on(\Modules\Achievement\Models\Achievement::TABLE)
                ->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\Achievement\Models\AchievementReward::TABLE);
    }
};

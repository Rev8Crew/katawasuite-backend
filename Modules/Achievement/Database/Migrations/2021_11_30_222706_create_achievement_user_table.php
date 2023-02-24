<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('achievement_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('achievement_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('achievement_id')
                ->references('id')
                ->on(\Modules\Achievement\Models\Achievement::TABLE)
                ->onDelete('CASCADE');

            $table->foreign('user_id')
                ->references('id')
                ->on(\Modules\User\Entities\User::TABLE)
                ->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('achievement_user');
    }
};

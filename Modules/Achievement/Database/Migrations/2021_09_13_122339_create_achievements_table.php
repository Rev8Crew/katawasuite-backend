<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(\Modules\Achievement\Models\Achievement::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('description')->nullable();

            $table->string('short')->nullable();

            $table->unsignedBigInteger('game_id')->index()->nullable();
            $table->integer('is_active');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\Achievement\Models\Achievement::TABLE);
    }
};

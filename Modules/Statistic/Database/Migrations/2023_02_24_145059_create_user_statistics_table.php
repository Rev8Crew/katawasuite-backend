<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_statistics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('game_id')->index()->nullable();

            $table->string('option')->index();
            $table->string('value')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on(\Modules\User\Entities\User::TABLE)
                ->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_statistics');
    }
};

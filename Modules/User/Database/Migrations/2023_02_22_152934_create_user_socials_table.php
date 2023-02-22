<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_socials', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('provider', 25);
            $table->string('provider_id', 25);
            $table->string('name', 255)->nullable()->comment('Имя пользователя');
            $table->string('avatar', 255)->nullable()->comment('Аватар пользователя');
            $table->string('email')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->unique(['provider', 'provider_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_socials');
    }
};

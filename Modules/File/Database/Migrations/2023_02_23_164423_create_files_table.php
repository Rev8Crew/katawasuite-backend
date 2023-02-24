<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();

            $table->string('path')->nullable();
            $table->string('url')->nullable();

            $table->string('name')->nullable();
            $table->string('mime')->nullable();
            $table->integer('is_active');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on(\Modules\User\Entities\User::TABLE)->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};

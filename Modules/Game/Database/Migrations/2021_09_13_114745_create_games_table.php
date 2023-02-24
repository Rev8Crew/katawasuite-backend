<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(\Modules\Game\Entities\Game::TABLE, function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('parent_id')->index()->default(0);

            $table->text('description')->nullable();
            $table->text('short_description')->nullable();

            $table->string('name')->nullable();
            $table->string('short')->unique();
            $table->string('width')->nullable();
            $table->string('height')->nullable();

            $table->unsignedInteger('is_active');
            $table->unsignedInteger('image_id')->nullable();

            $table->unsignedInteger('restriction')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\Game\Entities\Game::TABLE);
    }
};

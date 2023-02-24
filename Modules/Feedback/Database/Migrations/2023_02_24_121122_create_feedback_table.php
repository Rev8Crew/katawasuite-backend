<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(\Modules\Feedback\Entities\Feedback::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->index();

            $table->text('text');
            $table->string('relation')->default(\Modules\Feedback\Enums\FeedbackRelationEnum::Site->value);

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on(\Modules\User\Entities\User::TABLE)->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(\Modules\Feedback\Entities\Feedback::TABLE);
    }
};

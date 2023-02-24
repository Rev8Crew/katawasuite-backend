<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('notification_id')->references('id')->on(\Modules\Notification\Models\Notification::TABLE)->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on(\Modules\User\Entities\User::TABLE)->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_user');
    }
};

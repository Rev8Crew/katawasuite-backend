<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(\Modules\Notification\Models\NotificationDelivery::TABLE, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('notification_release_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('notification_release_id')->references('id')->on(\Modules\Notification\Models\NotificationDelivery::TABLE)->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(\Modules\Notification\Models\NotificationDelivery::TABLE);
    }
};

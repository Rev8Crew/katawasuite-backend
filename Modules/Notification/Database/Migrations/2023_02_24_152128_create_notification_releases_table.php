<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(\Modules\Notification\Models\NotificationRelease::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('body');
            $table->string('color');
            $table->string('icon');

            $table->unsignedBigInteger('notification_id');

            $table->foreign('notification_id')->references('id')->on(\Modules\Notification\Models\Notification::TABLE)->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(\Modules\Notification\Models\NotificationRelease::TABLE);
    }
};

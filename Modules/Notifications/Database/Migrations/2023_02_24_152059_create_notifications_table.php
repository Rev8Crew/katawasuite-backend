<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(\Modules\Notifications\Models\Notification::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('short')->nullable();
            $table->string('code')->index();
            $table->smallInteger('is_active');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(\Modules\Notifications\Models\Notification::TABLE);
    }
};

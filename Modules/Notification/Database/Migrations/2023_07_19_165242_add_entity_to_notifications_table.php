<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(\Modules\Notification\Models\Notification::TABLE, function (Blueprint $table) {
            $table->string('entity_class')->nullable();
            $table->string('entity_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table(\Modules\Notification\Models\Notification::TABLE, function (Blueprint $table) {
            $table->dropColumn('entity_class');
            $table->dropColumn('entity_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Game\Entities\Game;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(Game::TABLE, function (Blueprint $table) {
            $table->text('walkthrough')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table(Game::TABLE, function (Blueprint $table) {
            $table->dropColumn('walkthrough');
        });
    }
};

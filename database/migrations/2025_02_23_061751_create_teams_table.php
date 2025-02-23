<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('match');
            $table->decimal('price', 10, 2);
            $table->string('team_file'); // For uploaded team file
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('teams');
    }
};

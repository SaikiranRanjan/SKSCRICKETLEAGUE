<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('team_requested_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requested_team_id');
            $table->string('users_whatsapp_number');
            $table->enum('payment_received', ['yes', 'no'])->default('no');
            $table->enum('team_shared', ['yes', 'no'])->default('no');
            $table->timestamps();

            // Foreign key constraint (assuming `teams` table exists)
            $table->foreign('requested_team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('team_requested_users');
    }
};

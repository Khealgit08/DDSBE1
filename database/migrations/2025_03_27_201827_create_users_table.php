<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Primary Key (Auto Increment)
            $table->string('username');
            $table->string('password');
            $table->string('gender');
            $table->timestamps(); // Includes created_at & updated_at
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};

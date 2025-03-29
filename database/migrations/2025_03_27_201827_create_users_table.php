<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tblusers', function (Blueprint $table) {
            $table->id();  // Primary Key (Auto Increment)
            $table->string('username');
            $table->string('password');
            $table->string('gender');
            $table->unsignedBigInteger('jobid');
            $table->timestamps(); // Includes created_at & updated_at

            $table->foreign('jobid')->references('id')->on('tbluserjob')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('tblusers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job');
            $table->unsignedBigInteger('record_owner');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};

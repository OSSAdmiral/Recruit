<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('resume');
            $table->unsignedBigInteger('ReferringJob');
            $table->unsignedBigInteger('JobCandidate')->nullable();
            $table->unsignedBigInteger('Candidate');
            $table->unsignedBigInteger('ReferredBy');
            $table->unsignedBigInteger('AssignedRecruiter');
            $table->string('Relationship')->nullable();
            $table->string('KnownPeriod')->nullable();
            $table->text('Notes')->nullable();
            $table->unsignedBigInteger('CreatedBy')->nullable();
            $table->unsignedBigInteger('ModifiedBy')->nullable();
            $table->unsignedBigInteger('DeletedBy')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};

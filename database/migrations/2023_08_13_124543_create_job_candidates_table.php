<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('JobCandidateId')->nullable();
            $table->unsignedBigInteger('JobId')->nullable();
            $table->unsignedBigInteger('candidate');
            $table->string('mobile')->nullable();
            $table->string('Email');
            $table->string('ExperienceInYears')->nullable();
            $table->string('CurrentJobTitle')->nullable();
            $table->string('ExpectedSalary')->nullable();
            $table->json('SkillSet')->nullable();
            $table->string('HighestQualificationHeld')->nullable();
            $table->string('CurrentEmployer')->nullable();
            $table->string('CurrentSalary')->nullable();
            $table->string('Street')->nullable();
            $table->string('City')->nullable();
            $table->string('Country')->nullable();
            $table->string('ZipCode')->nullable();
            $table->string('State')->nullable();
            $table->string('CandidateStatus')->nullable();
            $table->string('CandidateSource')->nullable();
            $table->unsignedBigInteger('CandidateOwner')->nullable();
            $table->unsignedBigInteger('CreatedBy')->nullable();
            $table->unsignedBigInteger('ModifiedBy')->nullable();
            $table->unsignedBigInteger('DeletedBy')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_candidates');
    }
};

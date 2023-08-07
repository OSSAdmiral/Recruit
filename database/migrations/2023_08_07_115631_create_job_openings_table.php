<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->string('postingTitle');
            $table->string('NumberOfPosition');
            $table->string('JobTitle');
            $table->string('JobOpeningSystemID')->nullable();
            $table->string('TargetDate');
            $table->string('Status');
            $table->json('Industry')->nullable();
            $table->string('Salary')->nullable();
            $table->string('Department');
            $table->string('HiringManager')->nullable();
            $table->string('AssignedRecruiters')->nullable();
            $table->string('DateOpened');
            $table->string('JobType');
            $table->longText('RequiredSkill');
            $table->string('WorkExperience');
            $table->longText('JobDescription');
            $table->string('City');
            $table->string('Country');
            $table->string('State');
            $table->string('ZipCode');
            $table->boolean('RemoteJob');
            $table->unsignedBigInteger('CreatedBy')->nullable();
            $table->unsignedBigInteger('ModifiedBy')->nullable();
            $table->unsignedBigInteger('DeletedBy')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_openings');
    }
};

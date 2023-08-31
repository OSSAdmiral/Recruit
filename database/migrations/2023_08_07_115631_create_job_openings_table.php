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
            $table->string('Status')->default('new');
            $table->string('Industry')->nullable();
            $table->string('Salary')->nullable();
            $table->unsignedBigInteger('Department')->nullable();
            $table->string('HiringManager')->nullable();
            $table->string('AssignedRecruiters')->nullable();
            $table->string('DateOpened');
            $table->string('JobType');
            $table->json('RequiredSkill')->nullable();
            $table->string('WorkExperience');
            $table->longText('JobDescription')->nullable();
            $table->longText('JobRequirement')->nullable();
            $table->longText('JobBenefits')->nullable();
            $table->string('City')->nullable();
            $table->string('Country')->nullable();
            $table->string('State')->nullable();
            $table->string('ZipCode')->nullable();
            $table->boolean('RemoteJob')->default(false);
            $table->boolean('published_career_site')->default(false);
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

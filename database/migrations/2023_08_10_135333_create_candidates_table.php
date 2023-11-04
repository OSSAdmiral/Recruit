<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('CandidateId')->nullable();
            $table->string('email');
            $table->string('full_name')->virtualAs('concat(FirstName, \' \', LastName)');
            $table->string('FirstName')->nullable();
            $table->string('LastName');
            $table->string('Mobile')->nullable();
            $table->string('ExperienceInYears')->nullable();
            $table->string('CurrentJobTitle')->nullable();
            $table->string('ExpectedSalary')->nullable();
            $table->json('SkillSet')->nullable();
            $table->string('HighestQualificationHeld')->nullable();
            $table->string('CurrentEmployer')->nullable();
            $table->string('CurrentSalary')->nullable();
            $table->longText('AdditionalInformation')->nullable();
            $table->string('Street')->nullable();
            $table->string('City')->nullable();
            $table->string('Country')->nullable();
            $table->string('ZipCode')->nullable();
            $table->string('State')->nullable();
            $table->json('School')->nullable();
            $table->json('ExperienceDetails')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};

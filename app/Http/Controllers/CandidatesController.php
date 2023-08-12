<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    public function index()
    {
        return Candidates::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'CandidateId' => ['nullable'],
            'Email' => ['required'],
            'FirstName' => ['nullable'],
            'LastName' => ['required'],
            'Mobile' => ['nullable'],
            'ExperienceInYears' => ['nullable', 'numeric'],
            'CurrentJobTitle' => ['nullable'],
            'ExpectedSalary' => ['nullable'],
            'SkillSet' => ['nullable'],
            'HighestQualificationHeld' => ['nullable'],
            'CurrentEmployer' => ['nullable'],
            'CurrentSalary' => ['nullable'],
            'AdditionaInformation' => ['nullable'],
            'Street' => ['nullable'],
            'City' => ['nullable'],
            'Country' => ['nullable'],
            'ZipCode' => ['nullable'],
            'State' => ['nullable'],
            'CandidateStatus' => ['nullable'],
            'CandidateSource' => ['nullable'],
            'CandidateOwner' => ['nullable', 'integer'],
            'SchoolName' => ['nullable'],
            'SchoolMajor' => ['nullable'],
            'SchoolDegree' => ['nullable'],
            'SchoolDuration' => ['nullable'],
            'SchoolCurrentlyPursuing' => ['nullable'],
            'ExperienceDetails' => ['nullable'],
        ]);

        return Candidates::create($request->validated());
    }

    public function show(Candidates $candidates)
    {
        return $candidates;
    }

    public function update(Request $request, Candidates $candidates)
    {
        $request->validate([
            'CandidateId' => ['nullable'],
            'Email' => ['required'],
            'FirstName' => ['nullable'],
            'LastName' => ['required'],
            'Mobile' => ['nullable'],
            'ExperienceInYears' => ['nullable', 'numeric'],
            'CurrentJobTitle' => ['nullable'],
            'ExpectedSalary' => ['nullable'],
            'SkillSet' => ['nullable'],
            'HighestQualificationHeld' => ['nullable'],
            'CurrentEmployer' => ['nullable'],
            'CurrentSalary' => ['nullable'],
            'AdditionaInformation' => ['nullable'],
            'Street' => ['nullable'],
            'City' => ['nullable'],
            'Country' => ['nullable'],
            'ZipCode' => ['nullable'],
            'State' => ['nullable'],
            'CandidateStatus' => ['nullable'],
            'CandidateSource' => ['nullable'],
            'CandidateOwner' => ['nullable', 'integer'],
            'SchoolName' => ['nullable'],
            'SchoolMajor' => ['nullable'],
            'SchoolDegree' => ['nullable'],
            'SchoolDuration' => ['nullable'],
            'SchoolCurrentlyPursuing' => ['nullable'],
            'ExperienceDetails' => ['nullable'],
        ]);

        $candidates->update($request->validated());

        return $candidates;
    }

    public function destroy(Candidates $candidates)
    {
        $candidates->delete();

        return response()->json();
    }
}

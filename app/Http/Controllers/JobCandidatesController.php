<?php

namespace App\Http\Controllers;

use App\Models\JobCandidates;
use Illuminate\Http\Request;

class JobCandidatesController extends Controller
{
    public function index()
    {
        return JobCandidates::all();
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);

        return JobCandidates::create($request->validated());
    }

    public function show(JobCandidates $jobCandidates)
    {
        return $jobCandidates;
    }

    public function update(Request $request, JobCandidates $jobCandidates)
    {
        $request->validate([

        ]);

        $jobCandidates->update($request->validated());

        return $jobCandidates;
    }

    public function destroy(JobCandidates $jobCandidates)
    {
        $jobCandidates->delete();

        return response()->json();
    }
}

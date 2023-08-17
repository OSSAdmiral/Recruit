<?php

namespace App\Http\Controllers;

use App\Models\Referrals;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index()
    {
        return Referrals::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ReferringforJob' => ['required'],
            'Candidate' => ['required'],
            'Relationship' => ['nullable'],
            'KnownPeriod' => ['nullable'],
            'Notes' => ['nullable'],
        ]);

        return Referrals::create($request->validated());
    }

    public function show(Referrals $referrals)
    {
        return $referrals;
    }

    public function update(Request $request, Referrals $referrals)
    {
        $request->validate([
            'ReferringforJob' => ['required'],
            'Candidate' => ['required'],
            'Relationship' => ['nullable'],
            'KnownPeriod' => ['nullable'],
            'Notes' => ['nullable'],
        ]);

        $referrals->update($request->validated());

        return $referrals;
    }

    public function destroy(Referrals $referrals)
    {
        $referrals->delete();

        return response()->json();
    }
}

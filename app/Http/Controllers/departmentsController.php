<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;

class departmentsController extends Controller
{
    public function index()
    {
        return departments::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'DepartmentName' => ['required'],
            'ParentDepartment' => ['nullable'],
        ]);

        return departments::create($request->validated());
    }

    public function show(departments $departments)
    {
        return $departments;
    }

    public function update(Request $request, departments $departments)
    {
        $request->validate([
            'DepartmentName' => ['required'],
            'ParentDepartment' => ['nullable'],
        ]);

        $departments->update($request->validated());

        return $departments;
    }

    public function destroy(departments $departments)
    {
        $departments->delete();

        return response()->json();
    }
}

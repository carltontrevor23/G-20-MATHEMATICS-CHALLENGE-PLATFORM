<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    public function index()
    {
        return view ('upload-schools');
    }

    public function store(Request $request)
    {

        $schools = new School();
        $schools->name = $request->input('name');
        $schools->district = $request->input('district');
        $schools->registration_number = $request->input('registration_number');
        $schools->representative_name = $request->input('representative_name');
        $schools->email = $request->input('email');
        $schools->representative_password = $request->input('representative_password');

        $schools->save();

        return back()->withStatus(__('School details successfully uploaded into the system.'));
    
    }

    public function show(Schools $schools)
    {
        return view ('uploadschools');
    }

    public function displayRepDetails(School $schools)
    {
        $schools = School::select('representative_name','email','name')->get();

        if($schools->isEmpty()) {
            dd('No schools found');
        }

        return view ('pages.representatives', compact('schools'));
    }

    public function displaySchoolDetails()
    {
        $schools = School::all();

        if($schools->isEmpty()) {
            dd('No schools found');
        }

        return view ('pages.schools', compact('schools'));
    }

}

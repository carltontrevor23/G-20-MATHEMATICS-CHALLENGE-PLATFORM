<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('uploadschools');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //The data entered by the admin is first validated to ensure it meets the datatypes and the constraints specified
        /*$validatedData = $request->validate([
        'schoolName'=>'required|string|max:255',
        'district' => 'required|string|max:255',
        'schoolRegNo' => 'required|string|max:255',
        'repName' => ' required|string|max:255',
        'repEmail' => 'required|email|unique:schools, repEmail',
        ]);*/

        $schools = new School();
        $schools->schoolName = $request->input('schoolName');
        $schools->district = $request->input('district');
        $schools->schoolRegNo = $request->input('schoolRegNo');
        $schools->repName = $request->input('repName');
        $schools->repEmail = $request->input('repEmail');

        $schools->save();

        return back()->withStatus(__('School has been successfully uploaded into the system.'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools  $schools
     * @return \Illuminate\Http\Response
     */
    public function show(Schools $schools)
    {
        return view ('uploadschools');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schools  $schools
     * @return \Illuminate\Http\Response
     */
    public function edit(Schools $schools)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schools  $schools
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schools $schools)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schools  $schools
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schools $schools)
    {
        //
    }

    public function schoolUploadSuccess(SchoolRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('School has been successfully uploaded into the system.'));
    }
}

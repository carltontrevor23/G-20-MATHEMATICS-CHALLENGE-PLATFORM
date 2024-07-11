<?php

namespace App\Http\Controllers;

//use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploadNewChallenge = 'Upload New Challenge';
        $navName = 'Challenges';
        return view ('challenges/upload-challenge', compact('uploadNewChallenge','navName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('upload-challenge');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'file'=> 'required|mimes:xlsx,xls,csv|max:2048',
       ]);

       $file = $request->file('file');

       Excel::import(new \App\Imports\ChallengeImport, $file);

       return redirect()->back()->with('success', 'Question file uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schools  $schools
     * @return \Illuminate\Http\Response
     */
    public function show(Schools $schools)
    {
        //return view ('uploadschools');
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


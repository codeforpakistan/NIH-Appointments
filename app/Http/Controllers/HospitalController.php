<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\Department;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = Hospital::withCount('appointments','departments');
        return view('hospitals.index', [
            'hospitals' => $hospitals->latest()->paginate(env('PER_PAGE', 10))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospitals.form', [
            'departments' => Department::all()
        ]);
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
            'name' => 'required|string',
            'departments' => 'required|array|exists:App\Department,id',
            'latitude' => 'sometimes|string',
            'longitude' => 'sometimes|string'
        ]);

        $hospital = new Hospital();
        $hospital->name = $request->name;
        $hospital->save();

        return redirect()->route('hospitals.index')->with('success', 'Hospital created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        return view('hospitals.form', [
            'hospital' => $hospital,
            'departments' => Department::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name' => 'required|string',
            'departments' => 'required|array|exists:App\Department,id',
            'latitude' => 'sometimes|string',
            'longitude' => 'sometimes|string'
        ]);

        $hospital->name = $request->name;
        $hospital->save();

        $hospital->departments()->sync($request->departments);

        if ($hospital->wasChanged())
            $request->session()->flash('success', 'Hospital updated');
        return redirect()->route('hospitals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('hospitals.index')->with('success', 'Hospital deleted');
    }
}

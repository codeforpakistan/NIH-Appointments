<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Hospital;
use App\Department;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with('department','hospital')->latest();
        return view('doctors.index', [
            'doctors' => $doctors->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.form', [
            'departments' => Department::all(),
            'hospitals' => Hospital::all(),
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
            'hospital' => 'required|exists:App\Hospital,id',
            'department' => 'required|exists:App\Department,id',
        ]);

        $hospital = Hospital::with('departments')->find($request->hospital);
        if ($hospital->departments->contains('id', $request->department)) {
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->hospital_id = $request->hospital;
            $doctor->department_id = $request->department;
            $doctor->save();

            return redirect()->route('doctors.index')->with('success', 'Doctor created');
        } else {
            return redirect()->back()->with('error', 'Hospital does not have department');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.form', [
            'doctor' => $doctor,
            'departments' => Department::all(),
            'hospitals' => Hospital::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string',
            'hospital' => 'required|exists:App\Hospital,id',
            'department' => 'required|exists:App\Department,id',
        ]);

        $hospital = Hospital::with('departments')->find($request->hospital);
        if ($hospital->departments->contains('id', $request->department)) {
            
            $doctor->name = $request->name;
            $doctor->hospital_id = $request->hospital;
            $doctor->department_id = $request->department;
            $doctor->save();

            if ($doctor->wasChanged())
                $request->session()->flash('success', 'Doctor updated');
            return redirect()->route('doctors.index');
        } else {
            return redirect()->back()->with('error', 'Hospital does not have department');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted');
    }
}

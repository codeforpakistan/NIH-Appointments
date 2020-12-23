<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use App\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $appointments = $user->hasRole(['admin', 'staff', 'agent']) ? Appointment::with('hospital', 'user') : Appointment::where('user_id', \Auth::user()->id)->with('hospital');
        return view('appointments.index', [
            'appointments' => $appointments->latest()->paginate(),
            'hospitals' => Hospital::all()->pluck('name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.form', [
            'users' => User::role(['caller'])->get(),
            'hospitals' => Hospital::all(),
            'slots' => $this->generateDateRange()
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
            'caller'    => 'sometimes|exists:App\User,id',
            'hospital'  => 'required|exists:App\Hospital,id',
            'start'     => 'required|date',
            'slot'      => 'required',
        ]);

        $appointment = new Appointment;
        $appointment->slug = Str::uuid();
        if ($request->user()->hasRole('admin')) {
            $appointment->user_id = $request->filled('caller') ? $request->caller : $request->user()->id;
        } else {
            $appointment->user_id = $request->user()->id;
        }
        $appointment->hospital_id = $request->hospital;

        $start = \Carbon\Carbon::parse($request->start . ' ' . $request->slot, config('app.timezone'));
        $finish = \Carbon\Carbon::parse($request->start . ' ' . $request->slot, config('app.timezone'));
        $finish->addMinutes(15);

        $appointment->start = $start;
        $appointment->finish = $finish;
        $appointment->save();

        return redirect()->route('home')->with('success', 'Appointment booked');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.form', [
            'appointment' => $appointment,
            'users' => User::role(['caller'])->get(),
            'hospitals' => Hospital::all(),
            'slots' => $this->generateDateRange()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        // return $request;
        $request->validate([
            'caller'    => 'sometimes|exists:App\User,id',
            'hospital'  => 'required|exists:App\Hospital,id',
            'start'     => 'required|date',
            'slot'      => 'required',
        ]);

        $start = \Carbon\Carbon::parse($request->start . ' ' . $request->slot, config('app.timezone'));
        $finish = \Carbon\Carbon::parse($request->start . ' ' . $request->slot, config('app.timezone'));
        $finish->addMinutes(15);

        if ($request->user()->hasRole('admin')) {
            $appointment->user_id = $request->filled('caller') ? $request->caller : $request->user()->id;
        }
        $appointment->hospital_id = $request->hospital;
        $appointment->start = $start;
        $appointment->finish = $finish;
        $appointment->save();

        if ($appointment->wasChanged()) 
            $request->session()->flash('success', 'Appointment updated');

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('home')->with('success', 'Appoinment cancelled');
    }

    private function generateDateRange($interval = 15)
    {
        $dates = [];
        $start = \Carbon\Carbon::parse(now())->startOfDay();
        $finish = \Carbon\Carbon::parse(now())->endOfDay();
        for ($i = $start; $i <= $finish; $i->addMinutes($interval)) {
            array_push($dates, $i->format('g:ia'));
        }
        return $dates;
    }
}

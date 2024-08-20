<?php

namespace App\Http\Controllers;

use App\Mail\MechanicMeetingMail;
use App\Models\Client;
use App\Models\Mechanic;
use App\Models\Meeting;
use App\Models\User;
use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = Booking::all();
        foreach ($bookings as $booking) {
            $color = null;
            if ($booking->title == 'Test') {
                $color = '#924ACE';
            }
            if ($booking->title == 'Test 1') {
                $color = '#68B01A';
            }

            $events[] = [
                'id' => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color
            ];
        }
        return view('meetings.index', [
            'events' => $events,
            'vehicles' => Vehicle::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'vehicle_id' => 'required', // Make sure vehicle_id is also validated
            'status' => 'required', // Ensure status is included in the validation
        ]);
        // dd($request);
        $vehicle = Vehicle::where('id', $request->vehicle_id)
            ->select('id', 'license_plate')
            ->firstOrFail();

        $title = $request->status . ' - ' . $vehicle->license_plate;
        $startDate = $request->start_date; // Assuming format 'Y-m-d'
        $startTime = $request->start_time; // Assuming format 'H:i'

        $startDateTime = $startDate . ' ' . $startTime;

        $startDateTimeObj = new \DateTime($startDateTime);
         // Clone to preserve the original start DateTime
        // Add one hour to the start date and time for the end date
        $endDateTimeObj = clone $startDateTimeObj; // Clone to preserve the original start DateTime
        $endDateTimeObj->modify('+1 hour'); // Add one h
        
        $endDateTime = $endDateTimeObj->format('Y-m-d H:i:s');

        $booking = Booking::create([
            'title' => $title,
            'vehicle_id' => $request->vehicle_id,
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'status' => $request->status,
        ]);

        $color = null;

        if ($booking->title == 'Test') {
            $color = '#924ACE';
        }

        return redirect('/meetings')->with('success', __('messages.booking_created_successfully'));
    }
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }
    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
    public function create()
    {
        return view('meetings.create', [
            'mechanics' => Mechanic::all(),
        ]);
    }
}

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
            'title' => 'required|string'
        ]);

        $booking = Booking::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $color = null;

        if ($booking->title == 'Test') {
            $color = '#924ACE';
        }

        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $color ? $color : '',

        ]);
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

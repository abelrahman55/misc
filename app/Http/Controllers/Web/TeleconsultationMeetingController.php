<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TeleconsultationMeeting;
use App\Models\TeleconsultationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeleconsultationMeetingController extends Controller
{
    public function doctor_meetings($id)
    {
        $req = TeleconsultationRequest::findOrFail($id);
        $meetings = TeleconsultationMeeting::with(['doctor', 'client', 'request'])->where('teleconsultation_request_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.doctor.teleconsultation_requests.meetings', compact('meetings', 'req', 'id'));
    }

    public function patient_meetings($id)
    {
        $req = TeleconsultationRequest::findOrFail($id);
        $meetings = TeleconsultationMeeting::with(['doctor', 'client', 'request'])->where('teleconsultation_request_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.patient.teleconsultation_requests.meetings', compact('meetings', 'req', 'id'));
    }

    public function create_meeting(Request $request)
    {
        $req = TeleconsultationRequest::findOrFail($request->teleconsultation_request_id);
        
        $request->validate([
            'date' => ['required', 'date'],
            'time' => ['required'],
        ]);

        $roomName = 'teleconsultation_' . $req->id . '_' . Str::random(10);
        $meetingUrl = 'https://meet.jit.si/' . $roomName;

        TeleconsultationMeeting::create([
            'teleconsultation_request_id' => $req->id,
            'doctor_id' => $req->doctor_id,
            'client_id' => $req->client_id,
            'date' => $request->date,
            'time' => $request->time,
            'meeting_url' => $meetingUrl,
        ]);

        return back()->with('success', 'Meeting created successfully.');
    }

    public function join_meeting(TeleconsultationMeeting $meeting)
    {
        if ($meeting->ended) {
            return back()->withErrors(['error' => 'قمت بغلق الميتنج أو انتهى']);
        }

        $tz = 'Africa/Cairo';
        $start = \Carbon\Carbon::parse($meeting->date . ' ' . $meeting->time, $tz);
        $now = \Carbon\Carbon::now($tz);

        $allowedFrom = $start->copy()->subMinutes(10);
        $allowedTo = $start->copy()->addHours(2);

        if ($now->lt($allowedFrom)) {
            return back()->withErrors(['error' => 'لا يمكنك الدخول الآن، الدخول يبدأ قبل الميعاد بـ 10 دقائق.']);
        }

        if ($now->gt($allowedTo)) {
            return back()->withErrors(['error' => 'هذا الاجتماع انتهى ولا يمكن الانضمام الآن.']);
        }

        return view('open_meeting', [
            'url' => $meeting->meeting_url,
        ]);
    }

    public function end_meeting(TeleconsultationMeeting $meeting)
    {
        $meeting->update(['ended' => 1]);
        return redirect()->back()->with('success', 'تم الانهاء بنجاح');
    }
}

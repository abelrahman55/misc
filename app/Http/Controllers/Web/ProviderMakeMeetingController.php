<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageMakeMeeting;
use App\Models\PackageMakeOffer;
use App\Models\ProviderMakeMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProviderMakeMeetingController extends Controller
{
    //
    public function doctor_meetings()
    {
        $id       = request('id');
        $meetings = PackageMakeMeeting::with('user', 'offer')->where('offer_id', $id)->orderBy('id', 'desc')->paginate(10);
        // return $meetings;
        return view('package_meetings', compact('meetings', 'id'));
    }
    public function client_package_offer_meetings()
    {
        $id       = request('id');
        $meetings = PackageMakeMeeting::with('user', 'offer')->where('offer_id', $id)->orderBy('id', 'desc')->paginate(10);
        // return $meetings;
        return view('client_package_meetings', compact('meetings', 'id'));
    }
    public function create_package_meeting(Request $request)
    {
        $offer = PackageMakeOffer::where('id', $request->offer_id)->first();
        // return $offer;
        $request->validate([
            'date' => ['required', 'date'],
            'time' => ['required'],
        ]);

        // اسم روم فريد
        $roomName = 'appointment_' . (auth()->guard('web')->id() ?? 'guest') . '_' . Str::random(10);

        // لينك Jitsi اللي هيتخزّن في قاعدة البيانات
        $meetingUrl = 'https://meet.jit.si/' . $roomName;

        // احفظ الموعد
        PackageMakeMeeting::create([
            'doctor_id' => auth()->guard('web')->id(), // أو patient_id لو عندك
            'user_id'   => $offer?->user_id,           // حسب نظامك
            'date'      => $request->date,
            'time'      => $request->time,
            'offer_id'  => $offer->id,
            'meeting'   => $meetingUrl,
        ]);

        return back()->with('success', 'Meeting created successfully.');

    }
    public function package_meeting_join(PackageMakeMeeting $meeting)
    {
        if ($meeting->ended) {
            return back()->withErrors([
                'meeting_not_yet' => 'قمت بغلق الميتنج',
            ]);
        }
        $tz = 'Africa/Cairo';

        // وقت بداية الميتنج بتوقيت القاهرة
        $start = \Carbon\Carbon::parse($meeting->date . ' ' . $meeting->time, $tz);

        // الوقت الحالي بتوقيت القاهرة (خلي بالك من ده 👇)
        $now = \Carbon\Carbon::now($tz);

        // مؤقتًا بس علشان تتأكد:
        // ده هيطلع 2025-11-29 10:06:03 مثلًا
        // return $now->toDateTimeString();

        // مسموح بالدخول قبل المعاد بـ 10 دقايق
        $allowedFrom = $start->copy()->subMinutes(10);

        // مسموح لحد ساعتين بعد البداية
        $allowedTo = $start->copy()->addHours(2);

        if ($now->lt($allowedFrom)) {
            return back()->withErrors([
                'meeting_not_yet' => 'لا يمكنك الدخول الآن، الدخول يبدأ قبل الميعاد بـ 10 دقائق.',
            ]);
        }

        if ($now->gt($allowedTo)) {
            return back()->withErrors([
                'meeting_expired' => 'هذا الاجتماع انتهى ولا يمكن الانضمام الآن.',
            ]);
        }
        // return $meeting->meeting;
        return view('open_meeting', [
            'url' => $meeting->meeting,
        ]);
        // return redirect()->away($meeting->meeting);
    }
    public function client_meeting_join(PackageMakeMeeting $meeting)
    {
        if ($meeting->ended) {
            return back()->withErrors([
                'meeting_not_yet' => 'قمت بغلق الميتنج',
            ]);
        }
        $tz = 'Africa/Cairo';

        // وقت بداية الميتنج بتوقيت القاهرة
        $start = \Carbon\Carbon::parse($meeting->date . ' ' . $meeting->time, $tz);

        // الوقت الحالي بتوقيت القاهرة (خلي بالك من ده 👇)
        $now = \Carbon\Carbon::now($tz);

        // مؤقتًا بس علشان تتأكد:
        // ده هيطلع 2025-11-29 10:06:03 مثلًا
        // return $now->toDateTimeString();

        // مسموح بالدخول قبل المعاد بـ 10 دقايق
        $allowedFrom = $start->copy()->subMinutes(10);

        // مسموح لحد ساعتين بعد البداية
        $allowedTo = $start->copy()->addHours(2);

        if ($now->lt($allowedFrom)) {
            return back()->withErrors([
                'meeting_not_yet' => 'لا يمكنك الدخول الآن، الدخول يبدأ قبل الميعاد بـ 10 دقائق.',
            ]);
        }

        if ($now->gt($allowedTo)) {
            return back()->withErrors([
                'meeting_expired' => 'هذا الاجتماع انتهى ولا يمكن الانضمام الآن.',
            ]);
        }
        // return $meeting->meeting;
        return view('open_meeting', [
            'url' => $meeting->meeting,
        ]);
        // return redirect()->away($meeting->meeting);
    }
    public function end_package_meeting(PackageMakeMeeting $meeting)
    {
        // return $meeting;
        $meeting->update(['ended' => 1]);
        return redirect()->back()->with('success', 'تم الانهاء بنجاح');
    }
    public function offer_meetings()
    {
        $id       = request('id');
        $meetings = ProviderMakeMeeting::with('user', 'offer')->where('offer_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('client_meetings', compact('meetings'));
        // return $meetings;
    }
    public function provider_offer_meetings()
    {
        $id       = request('id');
        $meetings = PackageMakeMeeting::with('user', 'offer')->where('offer_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('provider_offer_meetings', compact('meetings'));
        // return $meetings;
    }

}

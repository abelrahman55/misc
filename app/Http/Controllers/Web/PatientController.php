<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageMakeOffer;
use App\Models\ProviderMakeOffer;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    //
    public function patient_doctors()
    {
        $doctors = PackageMakeOffer::with('provider')
            ->where('paid', 'success')
            ->select('provider_id', DB::raw('MAX(id) as latest_offer_id'))
            ->groupBy('provider_id')
            ->orderByDesc('latest_offer_id')
            ->paginate(10);
        // return $doctors;
        return view('patient_doctors', compact('doctors'));
    }
    public function patient_provider()
    {
        $doctors = ProviderMakeOffer::with('provider')
            ->where('paid', 'success')
            ->select('provider_id', DB::raw('MAX(id) as latest_offer_id'))
            ->groupBy('provider_id')
            ->orderByDesc('latest_offer_id')
            ->paginate(10);
        // return $doctors;
        return view('patient_doctors', compact('doctors'));
    }
}

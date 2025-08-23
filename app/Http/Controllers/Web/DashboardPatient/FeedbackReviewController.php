<?php

namespace App\Http\Controllers\Web\DashboardPatient;


use App\Http\Controllers\Controller;
use App\Services\Web\DashboardPatient\FeedbackReviewService;
use App\Http\Requests\Web\DashboardPatient\StorefeedbackReviewRequest;

class FeedbackReviewController extends Controller
{
    public function __construct(public FeedbackReviewService $feedbackReviewService){}

    public function index()
    {
        $data = $this->feedbackReviewService->index();
        return view('dashboard_patient.feedback_review.index',compact('data'));
    }

    public function store(StorefeedbackReviewRequest $request)
    {
        $this->feedbackReviewService->store($request->validated());
        return redirect()->back();
    }







}

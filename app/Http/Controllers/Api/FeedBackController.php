<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Feedback\AddFeedbackRequest;
use App\Services\Api\FeedbackService;

class FeedBackController{
    public function add_feedback(AddFeedbackRequest $request){
        $feedback=FeedbackService::AddFeedback($request->validated());
        return $feedback;
    }
}

<?php
namespace App\Services\Web\DashboardPatient;

use App\Models\FeedbackReview;
use App\Traits\HasImage;

class FeedbackReviewService
{
    use HasImage;
    public function __construct(public FeedbackReview $model)
    {}
    public function index()
    {
        return $this->model->get();
    }

    public function store($data)
    {
        $data['user_id'] = auth()->id();

        $feedback_review = $this->model->create($data);

        return $feedback_review;
    }





}

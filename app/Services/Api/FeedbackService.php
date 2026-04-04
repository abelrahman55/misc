<?php

namespace App\Services\Api;

use App\Models\Feedback;

class FeedbackService{
    static function AddFeedback($data)
{
    $lang = request()->header('lang', 'ar');
    $user_id = auth()->guard('users')->user()->id??null;
    $data['user_id'] = $user_id??null;
    $feedback = Feedback::create($data);

    if ($feedback) {
        $message = match ($lang) {
            'ar' => 'تم الإرسال بنجاح',
            'en' => 'Submitted successfully',
            'fr' => 'Envoyé avec succès',
            'gr' => 'Υποβλήθηκε με επιτυχία',
            default => 'تم الإرسال بنجاح',
        };

        return res_data('', $message, 200);
    }

    // في حالة فشل الإدخال
    $errorMessage = match ($lang) {
        'ar' => 'حدث خطأ أثناء الإرسال',
        'en' => 'An error occurred during submission',
        'fr' => 'Une erreur s\'est produite lors de l\'envoi',
        'gr' => 'Παρουσιάστηκε σφάλμα κατά την υποβολή',
        default => 'حدث خطأ أثناء الإرسال',
    };

    return res_data('', $errorMessage, 500);
}

}

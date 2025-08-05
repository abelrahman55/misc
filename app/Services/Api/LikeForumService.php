<?php
namespace App\Services\Api;

use App\Models\Forums;
use App\Models\LikeFourm;
use Illuminate\Support\Facades\Auth;

class LikeForumService
{
   static function MakeLikeForum($id, $data)
{
    $forum = Forums::findOrFail($id);
    $user = Auth::guard('users')->user();
    $data['user_id'] = $user->id;
    $data['forum_id'] = $forum->id;

    $reply = LikeFourm::updateOrCreate(
        ['user_id' => $user->id, 'forum_id' => $forum->id],
        $data
    );

    if ($reply) {
        $message = [
            'ar' => 'تم الانشاء بنجاح',
            'en' => 'Created successfully',
            'fr' => 'Créé avec succès',
            'gr' => 'Δημιουργήθηκε με επιτυχία',
        ];
        return res_data('', $message[request()->header('lang', 'ar')], 200);
    }

    $message = [
        'ar' => 'حدث خطأ',
        'en' => 'An error occurred',
        'fr' => 'Une erreur s\'est produite',
        'gr' => 'Παρουσιάστηκε σφάλμα',
    ];
    return res_data('', $message[request()->header('lang', 'ar')], 400);
}

  static function GetMakeLikeForum($id)
{
    $likesCount = LikeFourm::where('forum_id', $id)->where('like', 1)->count();
    $unlikesCount = LikeFourm::where('forum_id', $id)->where('like', 0)->count();

    $data = [
        'likes' => $likesCount,
        'unlikes' => $unlikesCount,
    ];

    return res_data($data, '', 200);
}

}

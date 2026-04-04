<?php
namespace App\Services\Api;

use App\Models\Forums;
use App\Models\ReplyFourms;
use Illuminate\Support\Facades\Auth;

class ReplyForumService
{
     static function MakeReplyForum($id,$data)
    {
        $forum = Forums::findOrFail($id);
        $user            = Auth::guard('users')->user();
        $data['user_id'] = $user->id;
        $data['forum_id'] = $forum->id;

        $forum = ReplyFourms::create($data);
        if ($forum) {
            $message = [
                'ar' => 'تم الانشاء بنجاح',
                'en' => 'Created successfully',
                'fr' => 'Créé avec успice',
                'gr' => 'Δημιουργηθει',
            ];
            return res_data('', $message[request()->header('lang', 'ar')], 200);
        }
        $message = [
            'ar' => 'حدث خطاء',
            'en' => 'An error occurred',
            'fr' => 'Une erreur s\'est produite',
            'gr' => 'Παρουσιάστηκε σφάλμα',
        ];
        return res_data('', $message[request()->header('lang', 'ar')], 400);
    }

    static function GetMakeReplyForum($id)
{
    $Reply_forums = ReplyFourms::where('forum_id', $id)->latest()->get();

    $data = $Reply_forums->map(function ($reply) {
        return [
            'id'         => $reply->id,
            'reply'      => $reply->reply,
            'created_at' => $reply->created_at,
            'user_name'  => $reply->user->f_name ?? '',
        ];
    });

    return res_data($data, '', 200);
}

}

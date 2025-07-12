<?php
namespace App\Services\Api;

use App\Models\Forums;
use Illuminate\Support\Facades\Auth;

class ForumService
{
    public static function MakeForum($data)
    {
        $user            = Auth::guard('users')->user();
        $data['user_id'] = $user->id;
        $categories      = $data['categories'];
        if (request()->hasFile('image')) {
            $data['image'] = self::UploadFile(request()->file('image'));
        }
        $forum = Forums::create($data);
        if ($forum) {
            if ($categories) {
                foreach ($categories as $category) {
                    $forum->categories()->attach($category);
                }
            }
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
        // return $forum;
    }
    public static function UploadFile($file)
    {
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('forums'), $file_name);
        return $file_name;
    }
    public static function GetMakeForum()
    {
        $forums = Forums::latest()->paginate();

        $data = $forums->getCollection()->map(function ($forum) {
            return [
                'id'        => $forum->id,
                'title'     => $forum->title,
                'content'   => $forum->content,
                'user_name' => $forum->user->f_name ?? '',
                'created_at' => $forum->created_at,
            ];
        });

        $result = [
            'data'         => $data,
            'current_page' => $forums->currentPage(),
            'last_page'    => $forums->lastPage(),
            'per_page'     => $forums->perPage(),
            'total'        => $forums->total(),
        ];

        return res_data($result, '', 200);
    }

}

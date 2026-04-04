<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Api\LikeForumService;
use App\Http\Requests\MakeLikeForumRequest;

class LikeForumsController extends Controller
{
    //
    public function make_like_forum($id,MakeLikeForumRequest $request){
        $forum=LikeForumService::MakeLikeForum($id,$request->validated());
        return $forum;
    }

    public function like_forum_data($id){
        $data=LikeForumService::GetMakeLikeForum($id);
        return $data;
    }
}

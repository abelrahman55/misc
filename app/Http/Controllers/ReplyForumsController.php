<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Api\ReplyForumService;
use App\Http\Requests\MakeReplyForumRequest;

class ReplyForumsController extends Controller
{
    //
    public function make_reply_forum($id,MakeReplyForumRequest $request){
        $forum=ReplyForumService::MakeReplyForum($id,$request->validated());
        return $forum;
    }

    public function reply_forum_data($id){
        $data=ReplyForumService::GetMakeReplyForum($id);
        return $data;
    }
}

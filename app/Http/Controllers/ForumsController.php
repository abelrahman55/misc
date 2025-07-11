<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeForumRequest;
use App\Services\Api\ForumService;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    //
    public function make_forum(MakeForumRequest $request){
        $forum=ForumService::MakeForum($request->validated());
        return $forum;
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function provider_pat_chat(){
        $id=request('id');

        return $id;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Modules\Conversations\Http\Requests\MakeConversationRequest;
use Modules\Conversations\Http\Requests\SendMessageRequest;

class ConversationsController extends Controller
{
    public function make_conversation(MakeConversationRequest $request){
        $sender=Auth::guard('clients')->user();
        $lang=request()->header('lang','ar');
        $data=$request->validated();
        // return $sender;
        $data['user_id']=$sender->id;
        // return $data;
        $check=Conversation::where(['user_id'=>$data['user_id'],'receiver_id'=>$sender->id])->orWhere(['user_id'=>$sender->id,'receiver_id'=>$data['user_id']])->first();
        if($check){
            return res_data($check->id,'',200);
        }
        $conversation=Conversation::create($data);
        if($conversation){
            return res_data($conversation->id,$lang=='ar'?'تم الطلب':'Success To Ask',200);
        }
        return res_data('',$lang=='ar'?'لم يتم الطلب':'Failed To Ask',400);
    }
    public function get_conversation(Request $request){
        $per_page=request()->query('per_page',10);
        $lang=request()->header('lang','ar');
        $user=Auth::guard('clients')->user();
        // $user_id=$request->input('user_id');
        // $sender_id=$request->input('sender_id');
        // $conversation=Conversation::where(['user_id'=>$user_id,'sender_id'=>$sender_id])->orWhere(['user_id'=>$sender_id,'sender_id'=>$user_id])->first();
        $conversation_id=request('id');
        $messages=Message::with('user')->where('conversation_id',$conversation_id)->orderBy('id','desc')->paginate($per_page);
        $messages->getCollection()->transform(function($item)use($user){
            return [
                'id'=>$item->id??0,
                "created_at"=>$item->created_at??"",
                'message'=>$item->message??'',
                'by_me'=>$item->user_id==$user->id?1:0,
                'user_name'=>isset($item->user)?$item->user->name??'':"",
                'user_image'=>isset($item->user)?$item->user->prof_img??'':"",
            ];
        });
        $data = [
            'data' => $messages->getCollection()->toArray(),
            'pagination' => [
                'total' => $messages->total(),
                'per_page' => $messages->perPage(),
                'current_page' => $messages->currentPage(),
                'pages_count' => $messages->lastPage(),
            ],
        ];
        return res_data($data,'',200);
    }
    public function send_message(SendMessageRequest $request){
        $lang=request()->header('lang','ar');
        $data=$request->validated();
        $data['user_id']=Auth::guard('clients')->user()->id;
        $message=Message::create($data);

        if($message){
            $firebaseData = [
        'message'            => $request->message??"",
        'conversation_id'    => $request->conversation_id??0,
        'sender_id'        => $data['user_id'],
        'created_at'        => $message->created_at->toDateTimeString(),
    ];

    Http::withoutVerifying()
        ->timeout(15)
        ->put("https://blue-bird-b475c-default-rtdb.firebaseio.com/conversations/{$data['conversation_id']}.json", $firebaseData);

            return res_data('',$lang=='ar'?'تم الارسال':'Success To Send',200);
        }
        return res_data('',$lang=='ar'?'لم يتم الارسال':'Failed To Send',400 );
    }
    public function messages()
    {
        $conversations = Conversation::with(['messages', 'receiver', 'sender'])->get();
        return view('messages', compact('conversations'));
    }
}

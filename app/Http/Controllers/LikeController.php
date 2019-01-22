<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Reply;
use App\Model\Like;


class LikeController extends Controller
{
    public function likeIt(Reply $reply){
        if($reply->like()->create([
                    //'user_id' => auth()->id()
                    'user_id' => 2
        ])){
            return response('Like to reply has been added.', 200);
        }
    }

    public function unlikeIt(Reply $reply){
        // $reply->like()->where(['user_id' => auth()->id()])->first()->delete()

        if($reply->like()->where('user_id', '=', 2)->first()->delete()){
            return response('Reply has successfully been unliked.', 200);
        }
    }

}

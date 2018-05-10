<?php

namespace App\Http\Controllers;

use App\models\Like;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        Like::create($data);
    }
    public function delete(Request $request)
    {
        $like = Like::find($request->id);
        $like->forcedelete();
    }
}

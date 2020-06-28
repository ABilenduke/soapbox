<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShareController extends Controller
{
    public function create($id) {
        $validator = Validator::make(request()->all(), [
            'type' => [
                'required',
                Rule::in([
                    'email',
                    'facebook',
                    'link',
                    'linkedin',
                    'pinterest',
                    'reddit',
                    'twitter'
                ]),
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid_share_request',
                'errors' => $validator->errors()
            ], 400);
        }

        \App\Share::create([
            'platform' => request()->type,
            'user_id' => request()->user() ? request()->user()->id : null,
            'article_id' => $id,
            'ip_address' => \Request::ip()
        ]);

        return response()->json(['message' => 'share_saved'], 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        Comment::create([
            'content' => $data['content'],
            'status' => 'pending',
            'user_id' => $request->user()->id,
            'review_id' => $data['review_id'],
        ]);

        return back()->with('success', 'Comment submitted for approval.');
    }
}

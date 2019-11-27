<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentCategoryController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body'        => 'required',
            'category_id' => 'required',
            'user_name'   => [
                function ($attribute, $value, $fail) {
                    $tmp_value = explode(' ',$value);

                    if (count($tmp_value) != 2) {
                        $fail('Имя должно содержать два слова, оба с большой буквы');
                    }elseif(!ctype_upper($tmp_value[1]{0})) {
                        $fail('Имя должно содержать два слова, оба с большой буквы');
                    }elseif(!ctype_upper($tmp_value[0]{0})){
                        $fail('Имя должно содержать два слова, оба с большой буквы');
                    }

                }
            ]
        ]);

        $all_request = $request->all();

        $all_request = [
            'user_name'        => $all_request['user_name'],
            'user_id'          => 0,
            'parent_id'        => 0,
            'body'             => $all_request['body'],
            'commentable_id'   => $all_request['category_id'],
            'commentable_type' => 'App\Category',
        ];
        $comment = Comment::create($all_request);

        return response()->json([
            'message' => 'Great success! New comment created',
            'comment' => $comment
        ]);
    }

    public function show($id)
    {
        $comment = Comment::where(
            ['commentable_id'   => $id],
            ['commentable_type' => 'App\Category']
        );
        if ($comment->count() > 0) {
            return $comment->get();
        }
        return response()->json(['message' => 'Comments Not Found'], 404);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'title'       => 'nullable',
            'description' => 'nullable'
        ]);

        $comment->update($request->all());

        return response()->json([
            'message' => 'Great success! Comment updated',
            'comment' => $comment
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Successfully deleted comment!'
        ]);
    }
}

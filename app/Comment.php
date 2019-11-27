<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    //Mass assigned
    protected $fillable = [
        'user_name',
        'user_id',
        'parent_id',
        'body',
        'commentable_id',
        'commentable_type'
        ];

//    public function getCommentByArticleId(){
//        return $this->morphMany('App\Article','commentable', 'comments');
//    }
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
}

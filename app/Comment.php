<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'is_relative_comment',
        'related_comment_id',
        'comment_text',
    ];

    public function children()
    {
        return $this->hasMany('App\Comment','related_comment_id','id');
    }

}

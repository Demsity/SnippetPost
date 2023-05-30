<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PhpParser\Node\Expr\Cast\String_;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'is_visable', 'user_id'];
    
    public function addLikeByUser($user_id, $post_id)
    {
        $like = new user_like_post;
        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $like->save();
    }

    public function removeLikeByUser($user_id, $post_id)
    {
        // dd($user_id && $post_id);
        user_like_post::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }

    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

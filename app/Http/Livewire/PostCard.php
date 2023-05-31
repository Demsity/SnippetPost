<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use App\Models\user_like_post;
use App\Models\UserFollow;
use Livewire\Component;

class PostCard extends Component
{
    public $post;
    public $post_id;
    public $user;
    public $date;
    public $isLiking;
    public $isFollowing;


    public function like()
    {
        $this->post->addLikeByUser(auth()->id(), $this->post_id);
        $this->isLiking = true;
    }

    public function unLike()
    {
        $this->post->removeLikeByUser(auth()->id(), $this->post_id);
        $this->isLiking = false;
    }

    public function follow()
    {
        $this->user->addFollowUser(auth()->id(), $this->post->user_id);
        $this->isFollowing = true;
    }

    public function unFollow()
    {
        $this->user->removeFollowUser(auth()->id(), $this->post->user_id);
        $this->isFollowing = false;
    }

    public function mount()
    {
        $this->post = Post::find($this->post_id);
        $this->user = User::find($this->post->user_id);
        $this->date = $this->post->created_at;
        $this->date = $this->date->format('Y-m-d');
        foreach(user_like_post::where('user_id', auth()->id())->where('post_id', $this->post_id)->get() as $like){
            if($like->post_id == $this->post->id)
            {
                $this->isLiking = true;
    
            }else 
            {
                $this->isLiking = false;
            }
        }
        foreach(UserFollow::where('primary_user_id', auth()->id())->where('following_user_id', $this->post->user_id)->get() as $following)
        {
            if($following->following_user_id == $this->post->user_id)
            {
                
                $this->isFollowing = true;
            }else {

                $this->isFollowing = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}

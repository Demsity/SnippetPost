<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class PostCard extends Component
{
    public $post;
    public $post_id;
    public $user;
    public $date;

    public function mount()
    {
        $this->post = Post::find($this->post_id);
        $this->user = User::find($this->post->user_id);
        $this->date = $this->post->created_at;
        $this->date = $this->date->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}

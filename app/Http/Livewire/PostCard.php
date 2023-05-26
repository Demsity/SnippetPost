<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostCard extends Component
{
    public $post;
    public $post_id;

    public function mount()
    {
        $this->post = Post::find($this->post_id);
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PostFeed extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::all()->where('is_visable', true);
    }

    public function render()
    {
        return view('livewire.post-feed');
    }
}

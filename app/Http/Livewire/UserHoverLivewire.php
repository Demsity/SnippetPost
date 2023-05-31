<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserHoverLivewire extends Component
{

    public $user_id;
    public $user_name;
    public $avatar_url;

    public function render()
    {
        return view('livewire.user-hover-livewire');
    }
}

<div>
    @foreach ($posts as $post)
        @livewire('post-card', ['post_id' => $post->id])
    @endforeach
</div>

<div class="flex justify-between border-solid border-2 border-sky-500 p-8 mb-3 rounded-2xl">
    <div>
        <h2 class="text-3xl mb-2">{{$post->title}}</h2>
        <p>{{$post->text}}</p>
    </div>
    <div class="flex-col gap-2 flex justify-self-center justify-center justify-items-center items-center">
        <img class="w-12 rounded-full" src='{{$user->avatar_url}}'/>
        <small><p class="text-center">{{$user->name}}</p></small>
        @if ($isLiking)
            <button wire:click="unLike">
                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
        @else
            <button wire:click="like">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
        @endif

        <small><p>{{$date}}</p></small>
          
    </div>

</div>

@props(['post' => $post])

<div class="mb-4">
    <div class="bg-gray-200 rounded-md p-4 flex flex-col">
        <div  class="flex items-center justify-between mb-2">
            <div>
                <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> 
                <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
            </div>

            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-500 px-2 py-0.5 rounded text-sm">Delete</button>
                </form>
            @endcan
        </div>
        <p class="mb-2">{{ $post->body }}</p>

        <div class="flex items-center">
            @auth
                @if (!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1 flex justify-between items-center">
                        @csrf
                        <button type="submit" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1 flex justify-between items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.4" stroke="red" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </form>
                @endif
            @endauth

            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        </div>
    </div>
</div>
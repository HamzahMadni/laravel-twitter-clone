@props(['user' => $user])

@auth
    @if (auth()->id() !== $user->id)
        @if(
            // TODO: clean up
            $follow = \App\Models\Follow::query()
                ->where('follower_user_id', auth()->id())
                ->where('followed_user_id', $user->id)
                ->first()
                ?->id
        )
            <form action="{{ route('users.follows.destroy', ['user' => $user, 'follow' => $follow]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <button class="bg-red-600 py-1 px-3 rounded hover:bg-red-500 text-white" type="submit">Unfollow</button>
            </form>
        @else
            <form action="{{ route('users.follows.store', $user, ) }}" method="post">
                @csrf
                <button class="bg-teal-900 py-1 px-3 rounded hover:bg-teal-800 text-white" type="submit">Follow</button>
            </form>
        @endif           
    @endif
@endauth
@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="text-white mb-4 flex justify-between items-center">
                <div class="">
                    <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                    <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and recieved {{ $user->recievedLikes->count() }} likes</p>
                </div>
                @auth
                    @if (
                        auth()->id() !== $user->id
                        && $follow = \App\Models\Follow::query()
                            ->where('follower_user_id', auth()->id())
                            ->where('followed_user_id', $user->id)
                            ->first()
                            ?->id
                    )
                        <form action="{{ route('users.follows.destroy', ['user' => $user, 'follow' => $follow]) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class="bg-teal-900 py-1 px-3 rounded hover:bg-teal-800" type="submit">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('users.follows.store', $user, ) }}" method="post">
                            @csrf
                            <button class="bg-teal-900 py-1 px-3 rounded hover:bg-teal-800" type="submit">Follow</button>
                        </form>
                    @endif           
                @endauth
            </div>


            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select your country</label>
                <select id="tabs" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option>Posts</option>
                    <option>Followers</option>
                    <option>Following</option>
                </select>
            </div>

            <div class="flex justify-between items-center divide-x-2 divide-gray-300" id="tabContainer">
                <div class="w-full">
                    <input class="hidden peer" type="radio" name="tab" id="posts" checked>
                    <label
                        for="posts"
                        class="inline-block text-center w-full p-4 text-gray-900 bg-gray-200 rounded-tl-lg cursor-pointer peer-checked:bg-white"
                        aria-current="page"
                    >
                        Posts
                    </label>
                </div>
                <div class="w-full">
                    <input class="hidden peer" type="radio" name="tab" id="followers">
                    <label
                        for="followers"
                        class="inline-block text-center w-full p-4 text-gray-900 bg-gray-200 cursor-pointer peer-checked:bg-white"
                        aria-current="page"
                    >
                        Followers
                    </label>
                </div>
                <div class="w-full">
                    <input class="hidden peer" type="radio" name="tab" id="following">
                    <label
                        for="following"
                        class="inline-block text-center w-full p-4 text-gray-900 bg-gray-200 rounded-tr-lg cursor-pointer peer-checked:bg-white"
                        aria-current="page"
                    >
                        Following
                    </label>
                </div>
            </div>
            <div class="bg-white p-6 rounded-b-lg space-y-4" id="postsContainer">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post="$post" />
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>{{ $user->name }} does not have any posts.</p>
                @endif
            </div>
            <div class="bg-white p-6 rounded-b-lg space-y-4 hidden" id="followersContainer">
                @if ($followers->count())
                    @foreach ($followers as $follower)
                    <div class="flex justify-between items-center bg-gray-200 rounded-lg p-4">
                        <div class="text-lg font-bold">{{ $follower->name }}</div>
                        
                    </div>
                    @endforeach

                    {{ $followers->links() }}
                @else
                    <p>{{ $user->name }} does not have any followers.</p>
                @endif
            </div>
            <div class="bg-white p-6 rounded-b-lg space-y-4 hidden" id="followingContainer">
                @if ($following->count())
                    @foreach ($following as $followed)
                        {{ $followed->name }}
                    @endforeach

                    {{ $followed->links() }}
                @else
                    <p>{{$user->name }} is not following anyone.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
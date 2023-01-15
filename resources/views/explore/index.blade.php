@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center px-2 sm:px-0 gap-8 mx-auto container w-full">
        <div class="w-full sm:w-8/12 bg-white p-6 rounded-lg">
            <div class="">
                <form action="{{ route('explore.index') }}" method="get" class="flex justify-between items-center">
                    <label for="username" class="sr-only">Find a friend</label>
                    <input
                        name="username"
                        value="{{ $username }}"
                        id="username"
                        class="bg-gray-100 border-2 focus-visible:outline-teal-500 w-full px-4 py-2 rounded mr-4 @error('username') border-red-500 @enderror"
                        placeholder="Find a friend..."
                        onfocus="this.setSelectionRange(this.value.length,this.value.length)"
                        autofocus
                    />
                    <button type="submit" class="inline bg-teal-900 hover:bg-teal-800 text-white px-4 py-2 rounded font-medium sm:w-fit">Search</button>
                </form>
                @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col justify-between items-center space-y-2 mt-4">
                @if ($users->count())                        
                    @foreach ($users as $user)
                        <x-user :user="$user" />
                    @endforeach
                @elseif (request()->query('username'))
                    <p class="text-red-500 mt-4">No users with that name.</p>
                @endif
            </div>
        </div>
        <div class="w-full sm:w-8/12 bg-white p-6 rounded-lg space-y-4">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection
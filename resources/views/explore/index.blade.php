@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center px-2 sm:px-0 gap-8 mx-auto container w-full">
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
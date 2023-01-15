<x-mail::message>
# Last Weeks Activity

Total likes recieved: **{{ $likes }}**

@if ($followers->count())
Your new followers:
@foreach ($followers as $follower)    
**{{ $follower->name}}**
@endforeach
@endif

@if ($mostLikedPost)
Your most liked post:
> "**{{$mostLikedPost->body}}**"
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

@props(['user' => $user])

<div class="flex justify-between items-center bg-gray-200 rounded-lg p-4 w-full">
    <div class="">
        <a href="{{ route('users.profile', $user) }}" class="font-bold py-1 px-3">
            {{ $user->name }}
        </a>
        <span class="text-sm text-gray-700">{{ "@{$user->username}" }}</span>
    </div>
    <x-follow-button :user="$user" />
</div>
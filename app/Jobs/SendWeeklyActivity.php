<?php

namespace App\Jobs;

use App\Mail\WeeklyActivity;
use App\Models\Like;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWeeklyActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected User $user) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $oneWeekAgoToday = today()->subDays(7);

        // Get count of likes received in the last week.
        $likes = $this->user->recievedLikes()
            ->where('likes.created_at', '>', $oneWeekAgoToday)
            ->count();

        // Get all new followers in the last week.
        $followers = $this->user->followers()
            ->where('follows.created_at', '>', $oneWeekAgoToday)
            ->get();

        // Get their most liked post in the last week.
        $mostLikedPost = $this->user->posts()->withCount('likes')
            ->where('posts.created_at', '>', $oneWeekAgoToday)
            ->orderBy('likes_count', 'desc')
            ->first();

        Mail::to($this->user)->send(new WeeklyActivity($likes, $followers, $mostLikedPost));
    }
}

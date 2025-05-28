<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Publish scheduled posts that are due';

    public function handle()
    {
        $posts = Post::with('platforms')
            ->where('status', 'scheduled')
            ->where('scheduled_time', '<=', now()->addMinute()) // Buffer
            ->get();


        foreach ($posts as $post) {
            \DB::transaction(function () use ($post) {
                $post->update(['status' => 'published']);
                $post->platforms()->updateExistingPivot(
                    $post->platforms->pluck('id'),
                    ['platform_status' => 'published']
                );
            });
        }
    }
}

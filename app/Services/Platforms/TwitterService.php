<?php

namespace App\Services\Platforms;

class TwitterService extends PlatformService
{
    public function validatePost(array $post): bool
    {
        return !empty($post['content']) &&
            strlen($post['content']) <= 280;
    }
}

<?php

namespace App\Services\Platforms;

class FacebookService extends PlatformService
{
    public function validatePost(array $post): bool
    {
        return !empty($post['title']) &&
            strlen($post['title']) <= 255 &&
            !empty($post['content']) &&
            strlen($post['content']) <= 5000;
    }
}

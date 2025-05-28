<?php

namespace App\Services\Platforms;

class LinkedInService extends PlatformService
{
    public function validatePost(array $post): bool
    {
        return !empty($post['title']) &&
            strlen($post['title']) <= 100 &&
            !empty($post['content']) &&
            strlen($post['content']) <= 1300;
    }
}

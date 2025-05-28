<?php

namespace App\Services\Platforms;

class InstagramService extends PlatformService
{
    public function validatePost(array $post): bool
    {
        // Instagram typically requires an image and content caption <= 2200 characters
        return !empty($post['image_url']) &&
            filter_var($post['image_url'], FILTER_VALIDATE_URL) &&
            !empty($post['content']) &&
            strlen($post['content']) <= 2200;
    }
}

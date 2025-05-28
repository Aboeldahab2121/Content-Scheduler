<?php

namespace App\Services\Platforms;

abstract class PlatformService
{
    abstract public function validatePost(array $post): bool;
}

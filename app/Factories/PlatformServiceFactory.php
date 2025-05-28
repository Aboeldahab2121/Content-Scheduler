<?php

namespace App\Factories;

use App\Enums\PlatformEnum;
use App\Services\Platforms\FacebookService;
use App\Services\Platforms\InstagramService;
use App\Services\Platforms\LinkedInService;
use App\Services\Platforms\PlatformService;
use App\Services\Platforms\TwitterService;
use InvalidArgumentException;

class PlatformServiceFactory
{
    public static function create(int $platformId): PlatformService
    {

        return match ($platformId) {
            PlatformEnum::FACEBOOK->value => new FacebookService(),
            PlatformEnum::TWITTER->value => new TwitterService(),
            PlatformEnum::LINKEDIN->value => new LinkedInService(),
            PlatformEnum::INSTAGRAM->value => new InstagramService(),
            default => throw new InvalidArgumentException("Unsupported platform ID: {$platformId}"),
        };
    }
}

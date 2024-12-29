<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\Set\ValueObject\LevelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/data/bin',
        __DIR__ . '/lib',
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withRules([
        RemoveAlwaysElseRector::class,
    ])
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0)
    ->withSets([LevelSetList::UP_TO_PHP_83])
;

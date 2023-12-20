<?= "<?php\n" ?>

declare(strict_types = 1);

use Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->paths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);

    $rectorConfig->phpVersion(PhpVersion::PHP_80);
    $rectorConfig->importNames(true, false);

    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(LevelSetList::UP_TO_PHP_80);
    $rectorConfig->import(SetList::PHP_81);
    $rectorConfig->import(SetList::PHP_82);

    // -- Symfony Framework
    $rectorConfig->import(SymfonyLevelSetList::UP_TO_SYMFONY_54);
    $rectorConfig->import(SymfonySetList::SYMFONY_CODE_QUALITY);

    //-- Skip some rules/files ...
    $rectorConfig->skip([
        ShortenElseIfRector::class,
        CallableThisArrayToAnonymousFunctionRector::class,
        AbsolutizeRequireAndIncludePathRector::class,
    ]);
};

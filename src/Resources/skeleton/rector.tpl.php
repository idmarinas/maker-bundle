<?= "<?php\n" ?>

declare(strict_types=1);

use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\TwigSetList;
use Rector\Core\Configuration\Option;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void
{
    // get parameters
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_74);
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::IMPORT_DOC_BLOCKS, false);
    $parameters->set(Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, __DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml');

    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::PHP_74);
    $containerConfigurator->import(SetList::PHP_80);
    $containerConfigurator->import(SetList::PHP_81);
    $containerConfigurator->import(SetList::FRAMEWORK_EXTRA_BUNDLE_40);
    $containerConfigurator->import(SetList::FRAMEWORK_EXTRA_BUNDLE_50);

    //-- Symfony Framework
    $containerConfigurator->import(SymfonySetList::SYMFONY_40);
    $containerConfigurator->import(SymfonySetList::SYMFONY_41);
    $containerConfigurator->import(SymfonySetList::SYMFONY_42);
    $containerConfigurator->import(SymfonySetList::SYMFONY_43);
    $containerConfigurator->import(SymfonySetList::SYMFONY_44);
    $containerConfigurator->import(SymfonySetList::SYMFONY_51);
    $containerConfigurator->import(SymfonySetList::SYMFONY_52);
    $containerConfigurator->import(SymfonySetList::SYMFONY_53);
    $containerConfigurator->import(SymfonySetList::SYMFONY_54);
    $containerConfigurator->import(SymfonySetList::SYMFONY_CODE_QUALITY);
    $containerConfigurator->import(SensiolabsSetList::FRAMEWORK_EXTRA_61);
    $containerConfigurator->import(TwigSetList::TWIG_240);
    $containerConfigurator->import(TwigSetList::TWIG_UNDERSCORE_TO_NAMESPACE);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_25);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_ORM_29);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_CODE_QUALITY);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_COMMON_20);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_DBAL_210);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_DBAL_211);
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_DBAL_30);

    //-- Skip some rules/files ...
    $parameters->set(Option::SKIP, [
        ShortenElseIfRector::class,
        CallableThisArrayToAnonymousFunctionRector::class,
        AbsolutizeRequireAndIncludePathRector::class
    ]);
};

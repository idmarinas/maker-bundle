<?= "<?php\n" ?>

/**
 * This file is part of Bundle "<?= $bundle_name ?>".
 *
 * @see https://github.com/<?= $composer_name ?>/
 *
 * @license https://github.com/<?= $composer_name ?>/blob/master/LICENSE.txt
 *
 * @since 1.0.0
 */

namespace <?= $namespace ?>\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class <?= $class_name ?> extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));

        $loader->load('services.php');
    }
}

<?php

/**
 * This file is part of Bundle "IDMarinas Maker Bundle".
 *
 * @see https://github.com/idmarinas/maker-bundle
 *
 * @license https://github.com/idmarinas/maker-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 1.0.0
 */

namespace Idm\Bundle\Maker\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class IdmMakerExtension extends ConfigurableExtension
{
    public function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));

        $loader->load('services.php');


        $container->setParameter('idmarinas_bundle.maker.dir_bundles', $mergedConfig['dir_bundles']);
    }
}

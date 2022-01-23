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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Maker\Maker\MakeBundle;

return static function (ContainerConfigurator $container)
{
    $container->services()
        ->set('idm.maker.make_bundle', MakeBundle::class)
            ->args([
                new ReferenceConfigurator('parameter_bag')
            ])
            ->tag('maker.command')
        // ->set('idm.notifications_bag', NotificationBag::class)
        //     ->alias(NotificationBag::class, 'idm.notifications_bag')

        // ->set('idm_advertising.networks.registry', NetworkRegistry::class)
        //     ->public()
        //     ->args([
        //         new ReferenceConfigurator('service_container'),
        //         [],
        //     ])
        // ->alias(NetworkRegistry::class, 'idm_advertising.networks.registry')
    ;
};

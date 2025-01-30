<?php
/**
 * Copyright 2022-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 30/01/2025, 19:35
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    IdmMakerBundle.php
 * @date    23/01/2022
 * @time    15:57
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Maker;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class IdmMakerBundle extends AbstractBundle
{
	public function loadExtension (array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$container->import(dirname(__DIR__) . '/config/services.php');
	}
}

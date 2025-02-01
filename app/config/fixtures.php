<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 31/01/2025, 19:07
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    fixtures.php
 * @date    30/01/2025
 * @time    19:01
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.1.0
 */

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
	// @formatter:off
	$container
		->services()
			->load('DataFixtures\\', dirname(__DIR__, 2) . '/fixtures')
			->public()
			->autowire()
			->autoconfigure()
	;
	// @formatter:on
};

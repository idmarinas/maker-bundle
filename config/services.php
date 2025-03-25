<?php
/**
 * Copyright 2022-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 14:23
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    services.php
 * @date    23/01/2022
 * @time    15:57
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Maker\Maker\Common\MakerCommonContact;
use Idm\Bundle\Maker\Maker\Settings\MakerSettingsBundle;
use Idm\Bundle\Maker\Maker\User\MakerUserBundle;

return function (ContainerConfigurator $container) {
	// @formatter:off
	$container->services()
		->set('idm_maker.make.user_bundle.files', MakerUserBundle::class)
			->args([
				'$fileManager' => service('maker.file_manager')
			])
			->tag('maker.command')

		->set('idm_maker.make.common_bundle.contact', MakerCommonContact::class)
			->tag('maker.command')

		->set('idm_maker.make.settings_bundle.files', MakerSettingsBundle::class)
			->tag('maker.command')
	;
	// @formatter::on
};

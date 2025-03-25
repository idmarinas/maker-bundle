<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 13:16
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    SourcesCommonBundle.php
 * @date    25/03/2025
 * @time    11:34
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Maker\Common\MakerCommonContact;

use Idm\Bundle\Maker\Maker\AbstractSources;

final class SourcesCommonBundle extends AbstractSources
{
	protected static function sourcesInternal (): array
	{
		return [
			// Entities
			...self::getEntities(),
			// Repositories
			'ContactRepository' => [
				'class'          => self::$generator->createClassNameDetails('ContactRepository', 'Repository\\Contact'),
				'use_statements' => [
					'Contact',
				],
				'variables'      => [
					'entity_class' => 'Contact',
				],
			],
			// Forms
			'ContactFormType'   => [
				'class'          => self::$generator->createClassNameDetails('ContactFormType', 'Form\\Contact'),
				'use_statements' => [
					'Contact',
				],
				'variables'      => [
					'entity_class' => 'Contact',
				],
			],
			// Controllers
			...self::getControllers(),
		];
	}

	private static function getEntities (): array
	{
		return [
			'Contact' => [
				'class'          => self::$generator->createClassNameDetails('Contact', 'Entity\\Contact'),
				'use_statements' => [
					'ContactRepository',
					'Log',
				],
				'variables'      => [
					'repository_class' => 'ContactRepository',
					'log_entry_class'  => 'Log',
				],
			],
			'Log'     => [
				'class' => self::$generator->createClassNameDetails('Log', 'Entity\\Contact'),
			],
		];
	}

	private static function getControllers (): array
	{
		return [
			'ContactController'     => [
				'class'          => self::$generator->createClassNameDetails('ContactController', 'Controller\\Contact'),
				'use_statements' => [
					'ContactFormType',
				],
				'variables'      => [
					'form_class' => 'ContactFormType',
				],
			],
			'ContactCrudController' => [
				'class'          => self::$generator->createClassNameDetails(
					'ContactCrudController',
					'Controller\\Admin\\Contact'
				),
				'use_statements' => [
					'Contact',
				],
				'variables'      => [
					'entity_class' => 'Contact',
				],
			],
		];
	}
}

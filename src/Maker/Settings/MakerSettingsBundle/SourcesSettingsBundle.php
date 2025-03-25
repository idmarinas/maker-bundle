<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 15:47
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    SourcesSettingsBundle.php
 * @date    25/03/2025
 * @time    11:42
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Maker\Settings\MakerSettingsBundle;

use Idm\Bundle\Maker\Maker\AbstractSources;

class SourcesSettingsBundle extends AbstractSources
{
	protected static function sourcesInternal (): array
	{
		$extra = [];

		$userClass = self::$generator->createClassNameDetails('User', 'Entity\\User');

		if (class_exists($userClass->getFullName())) {
			$extra = array_merge($extra, [
				'User'                  => [
					'class'  => $userClass,
					'ignore' => true,
				],
				'SettingUser'           => [
					'class'          => self::$generator->createClassNameDetails('SettingUser', 'Entity\\Setting'),
					'use_statements' => [
						'SettingUserRepository',
						'SettingUserLog',
						'User',
					],
					'variables'      => [
						'repository_class' => 'SettingUserRepository',
						'log_entry_class'  => 'SettingUserLog',
						'user_entity'      => 'User',
					],
				],
				'SettingUserLog'        => [
					'class' => self::$generator->createClassNameDetails('SettingUserLog', 'Entity\\Setting'),
				],
				'SettingUserRepository' => [
					'class'          => self::$generator->createClassNameDetails('SettingUserRepository', 'Repository\\Setting'),
					'use_statements' => [
						'SettingUser',
					],
					'variables'      => [
						'entity_class' => 'SettingUser',
					],
				],
			]);
		}

		return [
			...self::getEntities(),
			...self::getRepositories(),
			...self::getControllers(),
			...$extra,
		];
	}

	private static function getEntities (): array
	{
		return [
			'Setting'          => [
				'class'          => self::$generator->createClassNameDetails('Setting', 'Entity\\Setting'),
				'use_statements' => [
					'SettingRepository',
					'SettingLog',
				],
				'variables'      => [
					'repository_class' => 'SettingRepository',
					'log_entry_class'  => 'SettingLog',
				],
			],
			'SettingLog'       => [
				'class' => self::$generator->createClassNameDetails('SettingLog', 'Entity\\Setting'),
			],
			'SettingDomain'    => [
				'class'          => self::$generator->createClassNameDetails('SettingDomain', 'Entity\\Setting'),
				'use_statements' => [
					'SettingDomainRepository',
					'SettingDomainLog',
				],
				'variables'      => [
					'repository_class' => 'SettingDomainRepository',
					'log_entry_class'  => 'SettingDomainLog',
				],
			],
			'SettingDomainLog' => [
				'class' => self::$generator->createClassNameDetails('SettingDomainLog', 'Entity\\Setting'),
			],
		];
	}

	private static function getRepositories (): array
	{
		return [
			'SettingRepository'       => [
				'class'          => self::$generator->createClassNameDetails('SettingRepository', 'Repository\\Setting'),
				'use_statements' => [
					'Setting',
				],
				'variables'      => [
					'entity_class' => 'Setting',
				],
			],
			'SettingDomainRepository' => [
				'class'          => self::$generator->createClassNameDetails('SettingDomainRepository', 'Repository\\Setting'),
				'use_statements' => [
					'SettingDomain',
				],
				'variables'      => [
					'entity_class' => 'SettingDomain',
				],
			],
		];
	}

	private static function getControllers (): array
	{
		return [
			'SettingCrudController'       => [
				'class'          => self::$generator->createClassNameDetails(
					'SettingCrudController',
					'Controller\\Admin\\Setting'
				),
				'use_statements' => [
					'Setting',
				],
				'variables'      => [
					'class_entity' => 'Setting',
				],
			],
			'SettingDomainCrudController' => [
				'class'          => self::$generator->createClassNameDetails(
					'SettingDomainCrudController',
					'Controller\\Admin\\Setting'
				),
				'use_statements' => [
					'SettingDomain',
				],
				'variables'      => [
					'class_entity' => 'SettingDomain',
				],
			],
		];
	}
}

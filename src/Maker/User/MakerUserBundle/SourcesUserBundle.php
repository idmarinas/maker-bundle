<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 20:58
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    SourcesUserBundle.php
 * @date    11/02/2025
 * @time    16:13
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Maker\User\MakerUserBundle;

use Idm\Bundle\Maker\Maker\AbstractSources;

final class SourcesUserBundle extends AbstractSources
{
	protected static function sourcesInternal (): array
	{
		return [
			// Entities
			...self::getEntities(),
			// Repositories
			...self::getRepositories(),
			// Forms
			'RegistrationFormType' => [
				'class' => self::$generator->createClassNameDetails('RegistrationFormType', 'Form\\User'),
			],
			// Controllers
			...self::getController(),
		];
	}

	private static function getEntities (): array
	{
		$namePrefix = 'Entity\\User';

		return [
			'Connections'             => [
				'class'          => self::$generator->createClassNameDetails('Connections', $namePrefix),
				'use_statements' => [
					'ConnectionsLog',
				],
				'variables'      => [
					'log_entry_class' => 'ConnectionsLog',
				],
			],
			'ConnectionsLog'          => [
				'class' => self::$generator->createClassNameDetails('ConnectionsLog', $namePrefix),
			],
			'UserLog'                 => [
				'class' => self::$generator->createClassNameDetails('UserLog', $namePrefix),
			],
			'Premium'                 => [
				'class'          => self::$generator->createClassNameDetails('Premium', $namePrefix),
				'use_statements' => [
					'PremiumLog',
				],
				'variables'      => [
					'log_entry_class' => 'PremiumLog',
				],
			],
			'PremiumLog'              => [
				'class' => self::$generator->createClassNameDetails('PremiumLog', $namePrefix),
			],
			'ResetPasswordRequest'    => [
				'class'          => self::$generator->createClassNameDetails('ResetPasswordRequest', $namePrefix),
				'use_statements' => [
					'ResetPasswordRequestRepository',
					'ResetPasswordRequestLog',
					'User',
				],
				'variables'      => [
					'repository_class' => 'ResetPasswordRequestRepository',
					'log_entry_class'  => 'ResetPasswordRequestLog',
					'user_entity'      => 'User',
				],
			],
			'ResetPasswordRequestLog' => [
				'class' => self::$generator->createClassNameDetails('ResetPasswordRequestLog', $namePrefix),
			],
			'User'                    => [
				'class'          => self::$generator->createClassNameDetails('User', $namePrefix),
				'use_statements' => [
					'UserRepository',
					'UserLog',
					'Premium',
				],
				'variables'      => [
					'repository_class' => 'UserRepository',
					'premium_class'    => 'Premium',
					'log_entry_class'  => 'UserLog',
				],
			],
		];
	}

	private static function getController (): array
	{
		$namePrefix = 'Controller\\User';

		return [
			// Admin Crud Controller
			'UserCrudController'      => [
				'class'          => self::$generator->createClassNameDetails('UserCrudController', 'Controller\\Admin\\User'),
				'use_statements' => [
					'User',
				],
				'variables'      => [
					'user_entity' => 'User',
				],
			],
			// Controllers
			'LoginController'         => [
				'class' => self::$generator->createClassNameDetails('LoginController', $namePrefix),
			],
			'ProfileController'       => [
				'class' => self::$generator->createClassNameDetails('ProfileController', $namePrefix),
			],
			'RegistrationController'  => [
				'class'          => self::$generator->createClassNameDetails('RegistrationController', $namePrefix),
				'use_statements' => [
					'RegistrationFormType',
				],
				'variables'      => [
					'registration_form' => 'RegistrationFormType',
				],
			],
			'ResetPasswordController' => [
				'class' => self::$generator->createClassNameDetails('ResetPasswordController', $namePrefix),
			],
		];
	}

	private static function getRepositories (): array
	{
		return [
			'UserRepository'                 => [
				'class'          => self::$generator->createClassNameDetails('UserRepository', 'Repository\\User'),
				'use_statements' => [
					'User',
				],
				'variables'      => [
					'user_entity' => 'User',
				],
			],
			'ResetPasswordRequestRepository' => [
				'class'          => self::$generator->createClassNameDetails(
					'ResetPasswordRequestRepository',
					'Repository\\User'
				),
				'use_statements' => [
					'ResetPasswordRequest',
				],
				'variables'      => [
					'entity_class' => 'ResetPasswordRequest',
				],
			],
		];
	}
}

<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 18/02/2025, 15:06
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    sources.php
 * @date    11/02/2025
 * @time    16:13
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Symfony\Bundle\MakerBundle\Generator;

return function (Generator $generator): array {
	return [
		// Entities
		'Connections'                    => [
			'class'          => $generator->createClassNameDetails('Connections', 'Entity\\User'),
			'use_statements' => [
				'ConnectionsLog',
			],
			'variables'      => [
				'log_entry_class' => 'ConnectionsLog',
			],
		],
		'ConnectionsLog'                 => [
			'class' => $generator->createClassNameDetails('ConnectionsLog', 'Entity\\User'),
		],
		'Log'                            => [
			'class' => $generator->createClassNameDetails('Log', 'Entity\\User'),
		],
		'Premium'                        => [
			'class'          => $generator->createClassNameDetails('Premium', 'Entity\\User'),
			'use_statements' => [
				'PremiumLog',
			],
			'variables'      => [
				'log_entry_class' => 'PremiumLog',
			],
		],
		'PremiumLog'                     => [
			'class' => $generator->createClassNameDetails('PremiumLog', 'Entity\\User'),
		],
		'ResetPasswordRequest'           => [
			'class'          => $generator->createClassNameDetails('ResetPasswordRequest', 'Entity\\User'),
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
		'ResetPasswordRequestLog'        => [
			'class' => $generator->createClassNameDetails('ResetPasswordRequestLog', 'Entity\\User'),
		],
		'User'                           => [
			'class'          => $generator->createClassNameDetails('User', 'Entity\\User'),
			'use_statements' => [
				'UserRepository',
				'Log',
				'Premium',
			],
			'variables'      => [
				'repository_class' => 'UserRepository',
				'premium_class'    => 'Premium',
				'log_entry_class'  => 'Log',
			],
		],
		// Repositories
		'UserRepository'                 => [
			'class'          => $generator->createClassNameDetails('UserRepository', 'Repository\\User'),
			'use_statements' => [
				'User',
			],
			'variables'      => [
				'user_entity' => 'User',
			],
		],
		'ResetPasswordRequestRepository' => [
			'class'          => $generator->createClassNameDetails('ResetPasswordRequestRepository', 'Repository\\User'),
			'use_statements' => [
				'ResetPasswordRequest',
			],
			'variables'      => [
				'entity_class' => 'ResetPasswordRequest',
			],
		],
		// Forms
		'RegistrationFormType'           => [
			'class' => $generator->createClassNameDetails('RegistrationFormType', 'Form\\User'),
		],
		// Admin Crud Controller
		'UserCrudController'             => [
			'class'          => $generator->createClassNameDetails('UserCrudController', 'Controller\\Admin\\User'),
			'use_statements' => [
				'User',
			],
			'variables'      => [
				'user_entity' => 'User',
			],
		],
		// Controllers
		'LoginController'                => [
			'class' => $generator->createClassNameDetails('LoginController', 'Controller\\User'),
		],
		'ProfileController'              => [
			'class' => $generator->createClassNameDetails('ProfileController', 'Controller\\User'),
		],
		'RegistrationController'         => [
			'class'          => $generator->createClassNameDetails('RegistrationController', 'Controller\\User'),
			'use_statements' => [
				'RegistrationFormType',
			],
			'variables'      => [
				'registration_form' => 'RegistrationFormType',
			],
		],
		'ResetPasswordController'        => [
			'class' => $generator->createClassNameDetails('ResetPasswordController', 'Controller\\User'),
		],
	];
};

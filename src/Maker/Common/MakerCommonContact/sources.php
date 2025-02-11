<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/02/2025, 15:49
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    sources.php
 * @date    11/02/2025
 * @time    13:36
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
		'Contact'               => [
			'class'          => $generator->createClassNameDetails('Contact', 'Entity\\Contact'),
			'use_statements' => [
				'ContactRepository',
				'Log',
			],
			'variables'      => [
				'repository_class' => 'ContactRepository',
				'log_entry_class'  => 'Log',
			],
		],
		'Log'                   => [
			'class' => $generator->createClassNameDetails('Log', 'Entity\\Contact'),
		],
		// Repositories
		'ContactRepository'     => [
			'class'          => $generator->createClassNameDetails('ContactRepository', 'Repository\\Contact'),
			'use_statements' => [
				'Contact',
			],
			'variables'      => [
				'entity_class' => 'Contact',
			],
		],
		// Forms
		'ContactFormType'       => [
			'class'          => $generator->createClassNameDetails('ContactFormType', 'Form\\Contact'),
			'use_statements' => [
				'Contact',
			],
			'variables'      => [
				'entity_class' => 'Contact',
			],
		],
		// Controllers
		'ContactController'     => [
			'class'          => $generator->createClassNameDetails('ContactController', 'Controller\\Contact'),
			'use_statements' => [
				'ContactFormType',
			],
			'variables'      => [
				'form_class' => 'ContactFormType',
			],
		],
		'ContactCrudController' => [
			'class'          => $generator->createClassNameDetails('ContactCrudController', 'Controller\\Admin\\Contact'),
			'use_statements' => [
				'Contact',
			],
			'variables'      => [
				'entity_class' => 'Contact',
			],
		],
	];
};

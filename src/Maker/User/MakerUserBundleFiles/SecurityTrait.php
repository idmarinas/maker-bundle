<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 01/02/2025, 12:36
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    SecurityTrait.php
 * @date    01/02/2025
 * @time    12:11
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Maker\User\MakerUserBundleFiles;

use Idm\Bundle\User\Security\Checker\UserAdminChecker;
use Idm\Bundle\User\Security\Checker\UserChecker;
use Symfony\Bundle\MakerBundle\Util\ClassNameDetails;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

trait SecurityTrait
{
	/** @private */
	private function updateSecurityConfig (array $data, ClassNameDetails $classNameDetails): array
	{
		return array_merge_recursive($data, [
			'security' => [
				'providers'        => [
					'idm_user_provider' => [
						'entity' => [
							'class'    => $classNameDetails->getFullName(),
							'property' => 'email',
						],
					],
				],
				'firewalls'        => [
					'admin' => [
						'provider'         => 'idm_user_provider',
						'user_checker'     => UserAdminChecker::class,
						'form_login'       => [
							'login_path'          => 'idm_user_login',
							'check_path'          => 'idm_user_login',
							'enable_csrf'         => true,
							'form_only'           => true,
							'default_target_path' => 'idm_user_profile_index',
						],
						'login_throttling' => [
							'limiter' => 'idm_user.rate_limiter.login.admin',
						],
					],
					'main'  => [
						'provider'         => 'idm_user_provider',
						'user_checker'     => UserChecker::class,
						'form_login'       => [
							'login_path'          => 'idm_user_login',
							'check_path'          => 'idm_user_login',
							'enable_csrf'         => true,
							'form_only'           => true,
							'default_target_path' => 'idm_user_profile_index',
						],
						'login_throttling' => [
							'limiter' => 'idm_user.rate_limiter.login.main',
						],
					],
				],
				'password_hashers' => [
					PasswordAuthenticatedUserInterface::class => 'auto',
				],
			],
		]);
	}
}

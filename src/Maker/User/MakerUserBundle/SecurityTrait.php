<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 19/02/2025, 17:13
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

namespace Idm\Bundle\Maker\Maker\User\MakerUserBundle;

use Idm\Bundle\User\Security\Checker\UserAdminChecker;
use Idm\Bundle\User\Security\Checker\UserChecker;
use Symfony\Bundle\MakerBundle\Util\ClassNameDetails;

trait SecurityTrait
{
	/** @internal */
	private function updateSecurityConfig (array $data, ClassNameDetails $classNameDetails): array
	{
		$data['security']['firewalls']['admin']['provider'] = 'idm_user_provider';
		$data['security']['firewalls']['main']['provider'] = 'idm_user_provider';

		$data = array_merge_recursive($data, [
			'security' => [
				'providers' => [
					'idm_user_provider' => [
						'entity' => [
							'class'    => $classNameDetails->getFullName(),
							'property' => 'email',
						],
					],
				],
				'firewalls' => [
					'admin' => [
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
			],
		]);

		// To make the 'admin' firewall come before the 'main' firewall
		$admin = &$data['security']['firewalls']['admin'];
		$main = &$data['security']['firewalls']['main'];

		unset($data['security']['firewalls']['admin'], $data['security']['firewalls']['main']);

		$data['security']['firewalls']['admin'] = $admin;
		$data['security']['firewalls']['main'] = $main;

		return $data;
	}
}

<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 18/02/2025, 19:11
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    BundleInitializationTest.php
 * @date    18/02/2025
 * @time    17:06
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Tests;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

final class BundleInitializationTest extends KernelTestCase
{
	protected static function createKernel (array $options = []): KernelInterface
	{
		/** @var Kernel $kernel */
		$kernel = parent::createKernel($options);
		$kernel->handleOptions($options);

		return $kernel;
	}

	public function testInitBundle (): void
	{
		// Boot the kernel.
		$kernel = self::bootKernel();

		$container = static::getContainer();

		$this->assertTrue($container->has('idm_maker.make.user_bundle.files'));
		$this->assertTrue($container->has('idm_maker.make.common_bundle.contact'));
	}
}

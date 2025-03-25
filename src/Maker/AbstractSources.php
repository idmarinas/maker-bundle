<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 13:13
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    AbstractSources.php
 * @date    25/03/2025
 * @time    11:26
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Maker;

use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Component\PropertyAccess\Exception\UninitializedPropertyException;
use function Symfony\Component\String\u;

abstract class AbstractSources
{
	protected static Generator $generator;
	protected static bool      $initialized = false;

	public static function initialize (Generator $generator): void
	{
		self::$generator = $generator;
		self::$initialized = true;
	}

	public static function destroy (): void
	{
		self::$initialized = false;
	}

	final public static function sources (): array
	{
		if (!static::$initialized) {
			throw new UninitializedPropertyException(
				sprintf(
					'Need call to "%1$s::initialize()" before call "%1$s::%2$s()"',
					u(static::class)->afterLast('\\')->toString(),
					__FUNCTION__
				)
			);
		}

		return static::sourcesInternal();
	}

	abstract protected static function sourcesInternal (): array;
}

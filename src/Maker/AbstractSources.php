<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 11:28
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

abstract class AbstractSources
{
	protected static Generator $generator;

	abstract public static function getSources ();

	public static function setGenerator (Generator $generator): void
	{
		self::$generator = $generator;
	}
}

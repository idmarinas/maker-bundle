<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 20/02/2025, 14:39
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    ArrayUtilsTrait.php
 * @date    20/02/2025
 * @time    13:21
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Traits\Maker;

trait ArrayUtilsTrait
{
	/**
	 * Same as the php function <code>array_merge_recursive</code>, but this method does not convert values to arrays
	 * when they are not, updating their value.
	 */
	public static function arrayMergeRecursive (array $array1, array $array2): array
	{
		foreach ($array2 as $key => $value) {
			if (is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
				$array1[$key] = self::arrayMergeRecursive($array1[$key], $value);
			} else {
				$array1[$key] = $value;
			}
		}

		return $array1;
	}
}

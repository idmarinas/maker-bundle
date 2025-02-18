<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 18/02/2025, 15:16
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    MakeHelpFileTrait.php
 * @date    30/01/2025
 * @time    21:26
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Traits\Maker;

trait MakeHelpFileTrait
{
	final protected function getMakeHelpFileContents (string $fileName): string
	{
		return file_get_contents(sprintf('%s/config/help/%s', dirname(__DIR__, 3), $fileName));
	}
}

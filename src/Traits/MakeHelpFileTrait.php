<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 30/01/2025, 21:27
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

namespace Idm\Bundle\Maker\Traits;

trait MakeHelpFileTrait
{
    final protected function getMakeHelpFileContents (string $fileName): string
    {
        return file_get_contents(sprintf('%s/config/help/%s', dirname(__DIR__, 2), $fileName));
    }
}

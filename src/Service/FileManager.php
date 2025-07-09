<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 26/05/2025, 19:56
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    FileManager.php
 * @date    26/05/2025
 * @time    19:17
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Service;

use InvalidArgumentException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

final class FileManager
{
	public function __construct (private string $rootDir, private readonly Filesystem $fs)
	{
		$this->rootDir = Path::normalize($rootDir);
	}

	public function fileExists (string $fileName): bool
	{
		return file_exists(Path::makeAbsolute($fileName, $this->rootDir));
	}

	public function dumpFile (string $fileName, string $content): void
	{
		$this->fs->dumpFile(Path::makeAbsolute($fileName, $this->rootDir), $content);
	}

	public function getFileContents (string $fileName): string
	{
		if (!$this->fileExists($fileName)) {
			throw new InvalidArgumentException(sprintf('File "%s" does not exists', $fileName));
		}

		return file_get_contents(Path::makeAbsolute($fileName, $this->rootDir));
	}
}

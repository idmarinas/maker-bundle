<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 18/02/2025, 15:16
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    GenerateClassTrait.php
 * @date    10/02/2025
 * @time    21:30
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Traits\Maker;

use Exception;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\Util\ClassNameDetails;
use Symfony\Bundle\MakerBundle\Util\UseStatementGenerator;
use function Symfony\Component\String\u;

trait GenerateClassTrait
{
	protected static Generator $generator;

	/** @internal */
	protected abstract static function getTpl (string $file): string;

	/**
	 * @throws Exception
	 */
	public function generateClasses (array $sources): void
	{
		foreach ($sources as $name => $source) {
			$useStatements = new UseStatementGenerator(
				array_map(fn($use) => $sources[$use]['class']->getFullName(), $source['use_statements'] ?? [])
			);
			$variables = array_merge($source['variables'] ?? [], [
				'use_statements' => $useStatements,
			]);

			$this->generateClass($source['class'], $name, $variables);
		}
	}

	/**
	 * @throws Exception
	 */
	protected function generateClass (ClassNameDetails $class, string $name, array $variables): void
	{
		$namespace = $this->getNamespaceWithOutRootNamespace($class);
		$template = self::getTpl(sprintf('src\\%s\\%s.tpl.php', $namespace, $name));

		self::$generator->generateClass($class->getFullName(), $template, $variables);
	}

	protected function getNamespaceWithOutRootNamespace (ClassNameDetails $class): string
	{
		return u($class->getFullName())
			->trimStart(self::$generator->getRootNamespace())
			->trimEnd($class->getShortName())
			->trim('\\')
			->toString()
		;
	}
}

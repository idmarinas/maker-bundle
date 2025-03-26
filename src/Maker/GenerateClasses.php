<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 26/03/2025, 23:57
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    GenerateClasses.php
 * @date    25/03/2025
 * @time    11:52
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Maker;

use Exception;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\Util\ClassNameDetails;
use Symfony\Bundle\MakerBundle\Util\UseStatementGenerator;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\PropertyAccess\Exception\UninitializedPropertyException;
use function Symfony\Component\String\u;

final class GenerateClasses
{
	private static Generator $generator;
	private static ?string   $templatesPath;
	private static bool      $initialized = false;

	public static function initialize (Generator $generator, string $templatesPath): void
	{
		self::$generator = $generator;
		self::$templatesPath = u($templatesPath)->ensureStart('/')->ensureEnd('/')->toString();
		self::$initialized = true;
	}

	/**
	 * @throws Exception
	 */
	public static function generate (array $sources): void
	{
		if (!self::$initialized) {
			throw new UninitializedPropertyException(
				sprintf(
					'Need call to "%1$s::initialize()" before call "%1$s::%2$s()"',
					u(self::class)->afterLast('\\')->toString(),
					__FUNCTION__
				)
			);
		}

		foreach ($sources as $name => $source) {
			if ($source['ignore'] ?? false) {
				continue;
			}

			$useStatements = new UseStatementGenerator(
				array_map(fn($use) => $sources[$use]['class']->getFullName(), $source['use_statements'] ?? [])
			);
			$variables = array_merge($source['variables'] ?? [], [
				'use_statements' => $useStatements,
			]);

			self::generateClass($source['class'], $name, $variables);
		}
	}

	public static function destroy (): void
	{
		self::$initialized = false;
		self::$templatesPath = null;
	}

	protected static function getNamespaceWithOutRootNamespace (ClassNameDetails $class): string
	{
		return u($class->getFullName())
			->trimStart(self::$generator->getRootNamespace())
			->trimEnd($class->getShortName())
			->trim('\\')
			->toString()
		;
	}

	/**
	 * @throws Exception
	 */
	protected static function generateClass (ClassNameDetails $class, string $name, array $variables): void
	{
		$namespace = self::getNamespaceWithOutRootNamespace($class);
		$template = self::getTpl(sprintf('src\\%s\\%s.tpl.php', $namespace, $name));

		self::$generator->generateClass($class->getFullName(), $template, $variables);
	}

	/** @internal */
	private static function getTpl (string $file): string
	{
		return Path::canonicalize(dirname(__DIR__, 2) . self::$templatesPath . $file);
	}
}

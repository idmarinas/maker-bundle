<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 25/03/2025, 19:31
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    ClassManipulator.php
 * @date    25/03/2025
 * @time    16:21
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Maker;

use Doctrine\ORM\EntityNotFoundException;
use Nette\PhpGenerator\ClassLike;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use ReflectionClass;
use ReflectionException;

/** @method ClassType from() */
final class ClassManipulator
{
	private static ?PhpNamespace            $namespace;
	private static null|ClassType|ClassLike $class;

	public static function destroy (): void
	{
		self::$namespace = null;
		self::$class = null;
	}

	/**
	 * @throws ReflectionException
	 */
	public static function updateEntityClass (string $fullEntityClass): void
	{
		if (!class_exists($fullEntityClass)) {
			throw new EntityNotFoundException(sprintf('Entity "%s"  was not found.', $fullEntityClass));
		}

		self::$class = ClassType::from($fullEntityClass, true);
		self::$namespace = new PhpNamespace(self::getNamespace($fullEntityClass));

		self::$namespace->addUse('Doctrine\ORM\Mapping', 'ORM');
		self::$namespace->add(self::$class);

		self::addUseExtends();
	}

	public static function addUses (array $uses): void
	{
		foreach ($uses as $use) {
			self::$namespace->addUse($use);
		}
	}

	public static function namespace (): PhpNamespace
	{
		return self::$namespace;
	}

	public static function class (): ClassType
	{
		return self::$class;
	}

	public static function addMethod (string $name): Method
	{
		return self::$class->hasMethod($name) ? self::$class->getMethod($name) : self::$class->addMethod($name);
	}

	/**
	 * @throws ReflectionException
	 */
	public static function getNamespace (string $fullClassName): string
	{
		return (new ReflectionClass($fullClassName))->getNamespaceName();
	}

	/**
	 * @throws ReflectionException
	 */
	public static function getPathOfClass (string $fullClassName): string
	{
		return (new ReflectionClass($fullClassName))->getFileName();
	}

	public static function getFileContent (): string
	{
		$file = new PhpFile();
		$file->addNamespace(self::$namespace);

		return $file;
	}

	private static function addUseExtends (): void
	{
		if (null !== $extends = self::$class->getExtends()) {
			self::$namespace->addUse($extends);
		}
	}
}

<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/02/2025, 16:04
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    MakerCommonContact.php
 * @date    10/02/2025
 * @time    21:06
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Maker\Maker\Common;

use Exception;
use Idm\Bundle\Common\IdmCommonBundle;
use Idm\Bundle\Common\Model\Controller\AbstractContactController;
use Idm\Bundle\Maker\Traits\GenerateClassTrait;
use Idm\Bundle\Maker\Traits\MakeHelpFileTrait;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Exception\RuntimeCommandException;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

final class MakerCommonContact extends AbstractMaker
{
	use MakeHelpFileTrait;
	use GenerateClassTrait;

	/**
	 * @inheritDoc
	 */
	public static function getCommandName (): string
	{
		return 'make:idm:common:contact';
	}

	public static function getCommandDescription (): string
	{
		return 'Create the Basic Contact System files';
	}

	/**
	 * @inheritDoc
	 */
	public function configureCommand (Command $command, InputConfiguration $inputConfig): void
	{
		$command->setHelp($this->getMakeHelpFileContents('MakeCommonBundleContact.txt'));
	}

	/**
	 * @inheritDoc
	 */
	public function configureDependencies (DependencyBuilder $dependencies): void
	{
		$dependencies->addClassDependency(IdmCommonBundle::class, 'idmarinas/common-bundle');

		if (!class_exists(AbstractContactController::class)) {
			throw new RuntimeCommandException(
				'Please run "composer upgrade idmarinas/common-bundle". Version 3.4 or greater of this bundle is required.'
			);
		}
	}

	/**
	 * @inheritDoc
	 * @throws Exception
	 */
	public function generate (InputInterface $input, ConsoleStyle $io, Generator $generator): void
	{
		self::$generator = $generator;

		$sources = include __DIR__ . '/MakerCommonContact/sources.php';

		$this->generateClasses($sources($generator));

		$generator->writeChanges();

		$this->writeSuccessMessage($io);
	}

	/** @inheritdoc */
	protected static function getTpl (string $file): string
	{
		return 'templates/common/contact/' . $file;
	}
}

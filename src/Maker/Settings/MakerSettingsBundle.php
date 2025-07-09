<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 26/05/2025, 19:01
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    MakerSettingsBundle.php
 * @date    25/03/2025
 * @time    11:42
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.1.0
 */

namespace Idm\Bundle\Maker\Maker\Settings;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;
use Exception;
use Idm\Bundle\Maker\Maker\ClassManipulator;
use Idm\Bundle\Maker\Maker\GenerateClasses;
use Idm\Bundle\Maker\Maker\Settings\MakerSettingsBundle\SourcesSettingsBundle;
use Idm\Bundle\Maker\Service\FileManager;
use Idm\Bundle\Maker\Traits\Maker\ArrayUtilsTrait;
use Idm\Bundle\Maker\Traits\Maker\MakeHelpFileTrait;
use Idm\Bundle\Settings\Interfaces\Entity\EntityWithSettingsInterface;
use Idm\Bundle\Settings\Model\Entity\AbstractSetting;
use Idm\Bundle\Settings\Model\Entity\AbstractSettingDomain;
use Nette\PhpGenerator\Type;
use ReflectionException;
use Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Util\ClassNameDetails;
use Symfony\Bundle\MakerBundle\Util\YamlSourceManipulator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

final class MakerSettingsBundle extends AbstractMaker
{
	use MakeHelpFileTrait;
	use ArrayUtilsTrait;

	public function __construct (private readonly FileManager $fileManager) {}

	/**
	 * @inheritDoc
	 */
	public static function getCommandName (): string
	{
		return 'make:idm:settings:bundle';
	}

	public static function getCommandDescription (): string
	{
		return 'Create the Settings Bundle related files';
	}

	/**
	 * @inheritDoc
	 */
	public function configureCommand (Command $command, InputConfiguration $inputConfig): void
	{
		$command->setHelp($this->getMakeHelpFileContents('MakeSettingsBundleFile.txt'));
	}

	/**
	 * @inheritDoc
	 */
	public function configureDependencies (DependencyBuilder $dependencies): void
	{
		$dependencies->addClassDependency(StofDoctrineExtensionsBundle::class, 'stof/doctrine-extensions-bundle');
		$dependencies->addClassDependency(DoctrineBundle::class, 'doctrine/doctrine-bundle');
	}

	/**
	 * @inheritDoc
	 * @throws Exception
	 */
	public function generate (InputInterface $input, ConsoleStyle $io, Generator $generator): void
	{
		GenerateClasses::initialize($generator, '/templates/settings/bundle/');
		SourcesSettingsBundle::initialize($generator);

		$sources = SourcesSettingsBundle::sources();

		GenerateClasses::generate($sources);

		if (isset($sources['User']['class'])) {
			$content = $this->updateUserEntity($sources['User']['class'], $sources['SettingUser']['class']);

			$generator->dumpFile(ClassManipulator::getPathOfClass($sources['User']['class']->getFullName()), $content);

			ClassManipulator::destroy();
		}

		extract($this->configDoctrineYaml($sources));
		$generator->dumpFile($doctrineYaml, $doctrineContents);

		$generator->writeChanges();

		$this->writeSuccessMessage($io);

		GenerateClasses::destroy();
	}

	/** @internal */
	private function configDoctrineYaml (array $sources): array
	{
		$doctrineYaml = 'config/packages/doctrine.yaml';

		$manipulator = new YamlSourceManipulator($this->fileManager->getFileContents($doctrineYaml));
		$data = $manipulator->getData();

		$entities = [
			AbstractSetting::class       => $sources['Setting']['class']->getFullName(),
			AbstractSettingDomain::class => $sources['SettingDomain']['class']->getFullName(),
		];

		if (isset($sources['User']['class'])) {
			$entities[EntityWithSettingsInterface::class] = $sources['User']['class']->getFullName();
		}

		$data = self::arrayMergeRecursive($data, [
			'doctrine' => [
				'orm' => [
					'resolve_target_entities' => $entities,
				],
			],
		]);

		$manipulator->setData($data);
		$doctrineContents = $manipulator->getContents();

		return compact('doctrineYaml', 'doctrineContents');
	}

	/**
	 * @throws ReflectionException
	 */
	private function updateUserEntity (ClassNameDetails $userEntity, ClassNameDetails $targetEntity): string
	{
		ClassManipulator::updateEntityClass($userEntity->getFullName());

		ClassManipulator::addUses([
			ArrayCollection::class,
			$targetEntity->getFullName(),
			EntityWithSettingsInterface::class,
			Collection::class,
			AbstractSetting::class,
		]);

		ClassManipulator::class()->addImplement(EntityWithSettingsInterface::class);

		ClassManipulator::class()->addProperty('settings')
			->setPrivate()
			->setType(Collection::class)
			->addComment('@var Collection<int, AbstractSetting>')
			->addAttribute(OneToMany::class, [
				'targetEntity' => $targetEntity->getFullName(),
				'mappedBy'     => 'entity',
				'cascade'      => ['all'],
			])
		;

		ClassManipulator::addMethod('__construct')
			->addBody('')
			->addBody('$this->settings = new ArrayCollection();')
		;

		ClassManipulator::addMethod('getSettings')
			->setBody('return $this->settings;')
			->setReturnType(Collection::class)
		;

		ClassManipulator::addMethod('addSetting')
			->setReturnType('self')
			->addBody('if (!$this->settings->contains($setting)) {')
			->addBody('	$setting->setEntity($this);')
			->addBody('')
			->addBody('	$this->settings->add($setting);')
			->addBody('}')
			->addBody('return $this;')
			->addParameter('setting')
			->setType(Type::union($targetEntity->getFullName(), AbstractSetting::class))
		;

		ClassManipulator::addMethod('removeSetting')
			->setReturnType('self')
			->addBody('if ($this->settings->removeElement($setting) && $setting->getEntity() === $this) {')
			->addBody('	// set the owning side to null (unless already changed)')
			->addBody('	$setting->setEntity(null);')
			->addBody('}')
			->addBody('')
			->addBody('return $this;')
			->addParameter('setting')
			->setType(Type::union($targetEntity->getFullName(), AbstractSetting::class))
		;

		return ClassManipulator::getFileContent();
	}
}

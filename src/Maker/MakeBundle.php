<?php

/**
 * This file is part of Bundle "IDMarinas Maker Bundle".
 *
 * @see https://github.com/idmarinas/maker-bundle
 *
 * @license https://github.com/idmarinas/maker-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 1.0.0
 */

namespace Idm\Bundle\Maker\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use function Symfony\Component\String\u;

final class MakeBundle extends AbstractMaker
{
    private ParameterBagInterface $parameter;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameter = $parameterBag;
    }

    public static function getCommandName(): string
    {
        return 'make:bundle';
    }

    public static function getCommandDescription(): string
    {
        return 'Creates a new directory with the structure for a Bundle';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConf)
    {
        $command
            ->addArgument('namespace', InputArgument::OPTIONAL, sprintf('Choose a namespace for your Bundle (e.g. <fg=yellow>MyCompany\Bundle\%s</>)', Str::asClassName(Str::getRandomTerm(), 'Bundle')))
            ->addArgument('vendor', InputArgument::OPTIONAL, 'Choose a namespace for your Bundle (e.g. <fg=yellow>MyCompany</>)')
            ->setHelp('
The <info>%command.name%</info> command generates a new directory with the necesary structure for a Bundle.

If the argument is missing, the command will ask for the namespace for Bundle.')
        ;
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $bundleClassNameDetails = $generator->createClassNameDetails(
            $input->getArgument('namespace'),
            $input->getArgument('vendor'),
            'Bundle'
        );
        $bundleDetails         = $this->getBundleNameDetails($bundleClassNameDetails->getRelativeName());
        $bundleName            = $bundleDetails['bundle_name'];
        $bundleNameExtension   = u($bundleName)->replace('Bundle', 'Extension');
        $bundleNamePrefix      = $input->getArgument('vendor');
        $bundlePath            = $this->parameter->get('idmarinas_bundle.maker.dir_bundles').'/'.$bundleName;
        $composerName = u($bundleNamePrefix)->lower().'/'.u($bundleClassNameDetails->getShortName())->snake()->replace('_', '-');

        //-- Composer
        $generator->generateFile("{$bundlePath}/composer.json", $this->templatePath('composer.tpl.php'), [
            'composer_name' => $composerName,
            'namespace' => u($bundleClassNameDetails->getRelativeNameWithoutSuffix())->replace('\\', '\\\\')->append('\\\\')
        ]);
        $generator->generateFile("{$bundlePath}/.editorconfig", $this->templatePath('editorconfig.tpl.php'));
        $generator->generateFile("{$bundlePath}/.gitignore", $this->templatePath('gitignore.tpl.php'));
        $generator->generateFile("{$bundlePath}/.gitattributes", $this->templatePath('gitattributes.tpl.php'));
        $generator->generateFile("{$bundlePath}/LICENSE", $this->templatePath('LICENSE.tpl.php'));
        $generator->generateFile("{$bundlePath}/.php_cs-fixer.php", $this->templatePath('php_cs-fixer.tpl.php'));
        $generator->generateFile("{$bundlePath}/rector.php", $this->templatePath('rector.tpl.php'));
        $generator->generateFile("{$bundlePath}/TODO.md", $this->templatePath('TODO.tpl.php'));

        $generator->generateFile("{$bundlePath}/src/{$bundleName}.php", $this->templatePath('src/bundle.tpl.php'), [
            'composer_name' => $composerName,
            'class_name' => $bundleName,
            'namespace' => $bundleClassNameDetails->getRelativeNameWithoutSuffix()
        ]);
        $generator->generateFile("{$bundlePath}/src/DependencyInjection/{$bundleNameExtension}.php", $this->templatePath('src/DependencyInjection/extension.tpl.php'), [
            'composer_name' => $composerName,
            'bundle_name' => $bundleName,
            'class_name' => $bundleNameExtension,
            'namespace' => $bundleClassNameDetails->getRelativeNameWithoutSuffix()
        ]);
        $generator->generateFile("{$bundlePath}/src/Resources/config/services.php", $this->templatePath('src/Resources/config/services.tpl.php'), [
            'composer_name' => $composerName,
            'class_name' => $bundleName,
        ]);
        $generator->generateFile("{$bundlePath}/tests/.gitkeep", $this->templatePath('gitkeep.tpl.php'));

        $generator->writeChanges();

        $this->writeSuccessMessage($io);
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
        //-- Not need
    }

    private function templatePath(string $templateName): string
    {
        $templatePath = $templateName;
        if ( ! file_exists($templatePath))
        {
            $templatePath = dirname(__DIR__).'/Resources/skeleton/'.$templateName;

            if ( ! file_exists($templatePath))
            {
                throw new \Exception(sprintf('Cannot find template "%s"', $templateName));
            }
        }

        return $templatePath;
    }

    private function getBundleNameDetails(string $class)
    {
        $pos  = strpos($class, '\\');
        $name = false === $pos ? $class : substr($class, 0, $pos);

        return [
            'namespace_prefix'   => Str::getNamespace($class),
            'bundle_name_prefix' => $name,
            'bundle_name'        => $name.u(Str::getShortClassName($class))->trimPrefix($name),
        ];
    }
}

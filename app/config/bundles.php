<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 18/02/2025, 16:47
 *
 * @project IDMarinas Maker Bundle
 * @see     https://github.com/idmarinas/maker-bundle
 *
 * @file    bundles.php
 * @date    11/02/2025
 * @time    15:44
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Idm\Bundle\Maker\IdmMakerBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Zenstruck\Foundry\ZenstruckFoundryBundle;

return [
	FrameworkBundle::class        => ['all' => true],
	DoctrineBundle::class         => ['all' => true],
	IdmMakerBundle::class         => ['all' => true],
	SecurityBundle::class         => ['all' => true],

	// Dev-Test Bundles
	MakerBundle::class            => ['all' => true],
	ZenstruckFoundryBundle::class => ['all' => true],
];

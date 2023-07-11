<?php

// Usages (execute it in the project root directory):
//   docker run --rm --interactive --tty --volume $PWD:/app --workdir /app php:8.2 php app/Presenters/HomePresenterTest.php
//   docker run --rm --interactive --tty --volume $PWD:/app --workdir /app php:8.2 vendor/bin/tester -C app # executes ALL tests in the directory app

declare(strict_types=1);

namespace App\Presenters;

require __DIR__ . '/../../vendor/autoload.php';

use Tester\Assert;

/**
 * @testCase
 */
class HomePresenterTest extends \Tester\TestCase
{
	private \Nette\DI\Container $container;

	function __construct()
	{
		\Tester\Environment::setup();
		$configurator = \App\Bootstrap::boot();
		$this->container = $configurator->createContainer();
		//$this->somethingService = $container->getByType(\App\Services\SomethingService::class);
		//$this->somethingRepository = $container->getByType(\App\Repositories\SomethingRepository::class);
		//$this->databaseContext = $container->getByType(\Context::class);
	}

	protected function setUp(): void
	{
		parent::setUp();
	}

	protected function tearDown(): void
	{
		parent::tearDown();
	}

	function testTesting()
	{
		Assert::true(true);
	}

	function testDefaultAction()
	{
		//$_SERVER['REQUEST_URI'] = "/";
		$application = $this->container->getByType(\Nette\Application\Application::class);
		ob_start();
		$application->run();
		$html = ob_get_clean();
		$dom = \Tester\DomQuery::fromHtml($html);

		Assert::true($dom->has('div[id="banner"]'));
	}
}

(new HomePresenterTest())->run();


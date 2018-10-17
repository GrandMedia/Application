<?php declare(strict_types = 1);

namespace GrandMediaTests\Application\UI;

use GrandMedia\Application\UI\ComponentHelper;
use GrandMediaTests\Application\UI\Mocks\Parameter;
use GrandMediaTests\Application\UI\Mocks\Presenter;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class ComponentHelperTest extends \Tester\TestCase
{

	public function testLoadParameters(): void
	{
		$presenter = new Presenter();
		$presenter->changeAction('default');
		$presenter->setView('foo');
		$params = [
			'one' => 'one',
			'two' => 'two',
			'foo' => 'foo',
			'bar' => 'bar',
			'baz' => 'baz',
		];

		Assert::equal(
			[
				'one' => Parameter::fromString('one'),
				'two' => Parameter::fromString('two'),
				'foo' => Parameter::fromString('foo'),
				'bar' => Parameter::fromString('bar'),
				'baz' => Parameter::fromString('baz'),
			],
			ComponentHelper::loadParameters($presenter, $params)
		);
	}

}

(new ComponentHelperTest())->run();

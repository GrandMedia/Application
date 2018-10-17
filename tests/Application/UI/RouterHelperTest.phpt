<?php declare(strict_types = 1);

namespace GrandMediaTests\Application\UI;

use GrandMedia\Application\UI\RouterHelper;
use GrandMediaTests\Application\UI\Mocks\Parameter;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class RouterHelperTest extends \Tester\TestCase
{

	public function testFilerParametersOut(): void
	{
		Assert::same(
			[
				'one',
				'two',
				'three',
			],
			RouterHelper::filterParametersOut(
				[
					'one',
					Parameter::fromString('two'),
					'three',
				]
			)
		);
	}

}

(new RouterHelperTest())->run();

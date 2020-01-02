<?php declare(strict_types = 1);

namespace GrandMediaTests\Application\UI\Mocks;

final class Presenter extends \Nette\Application\UI\Presenter
{

	/**
	 * @var \GrandMediaTests\Application\UI\Mocks\Parameter
	 * @persistent
	 */
	public $bar;

	/**
	 * @var \GrandMediaTests\Application\UI\Mocks\Parameter
	 * @persistent
	 */
	public $baz;

	public function actionDefault(Parameter $one, Parameter $two): void
	{
	}

	public function renderFoo(Parameter $foo): void
	{
	}

}

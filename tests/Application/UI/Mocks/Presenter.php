<?php declare(strict_types = 1);

namespace GrandMediaTests\Application\UI\Mocks;

final class Presenter extends \Nette\Application\UI\Presenter
{

	/** @persistent */
	public Parameter $bar;

	/** @persistent */
	public Parameter $baz;

	public function actionDefault(Parameter $one, Parameter $two): void
	{
	}

	public function renderFoo(Parameter $foo): void
	{
	}

}

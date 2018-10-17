<?php declare(strict_types = 1);

namespace GrandMediaTests\Application\UI\Mocks;

final class Parameter implements \GrandMedia\Application\UI\Parameter
{

	/**
	 * @var string
	 */
	private $value;

	private function __construct()
	{
	}

	public static function fromString(string $string): \GrandMedia\Application\UI\Parameter
	{
		$parameter = new self();
		$parameter->value = $string;

		return $parameter;
	}

	public function toString(): string
	{
		return $this->value;
	}
}

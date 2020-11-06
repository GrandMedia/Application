<?php declare(strict_types = 1);

namespace GrandMediaTests\Application\UI\Mocks;

final class Parameter
{

	private string $value;

	private function __construct()
	{
	}

	public static function fromString(string $string): self
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

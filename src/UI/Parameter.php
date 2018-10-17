<?php declare(strict_types = 1);

namespace GrandMedia\Application\UI;

interface Parameter
{
	public static function fromString(string $string): self;

	public function toString(): string;
}

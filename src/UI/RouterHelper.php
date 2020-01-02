<?php declare(strict_types = 1);

namespace GrandMedia\Application\UI;

final class RouterHelper
{

	use \Nette\StaticClass;

	/**
	 * @param mixed[] $params
	 *
	 * @return  mixed[]
	 */
	public static function filterParametersOut(array $params): array
	{
		foreach ($params as &$param) {
			if (\is_callable([$param, 'toString'])) {
				$param = $param->toString();
			} elseif (\method_exists($param, '__toString')) {
				$param = (string) $param;
			}
		}

		return $params;
	}

}

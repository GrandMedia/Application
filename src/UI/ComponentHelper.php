<?php declare(strict_types = 1);

namespace GrandMedia\Application\UI;

use Nette\Application\Helpers;
use Nette\Application\UI\Component;
use Nette\Application\UI\Presenter;
use Nette\Reflection\AnnotationsParser;
use Nette\Utils\Reflection;
use Nette\Utils\Strings;

final class ComponentHelper
{

	use \Nette\StaticClass;

	/**
	 * @param mixed[] $params
	 *
	 * @return mixed[]
	 */
	public static function loadParameters(Component $component, array $params): array
	{
		$reflection = $component::getReflection();

		foreach ($reflection->getPersistentParams() as $name => $meta) {
			if (isset($params[$name])) {
				$annotations = AnnotationsParser::getAll($reflection->getProperty($name));
				if (isset($annotations['var'])) {
					$className = Reflection::expandClassName(\end($annotations['var']), $reflection);
					if (\is_string($params[$name]) && \is_callable([$className, 'fromString'])) {
						$params[$name] = \forward_static_call([$className, 'fromString'], $params[$name]);
					}
				}
			}
		}

		$methods = [];

		if ($component instanceof Presenter) {
			$methods[] = Presenter::formatActionMethod($component->action);
			$methods[] = Presenter::formatRenderMethod($component->view);
		}

		$signal = $component->getPresenter()->getSignal();
		if ($signal && $signal[0] === $component->getUniqueId()) {
			$methods[] = Component::formatSignalMethod($signal[1]);
		}

		foreach ($methods as $method) {
			if ($reflection->hasMethod($method)) {
				foreach ($reflection->getMethod($method)->getParameters() as $parameter) {
					$class = $parameter->getClass();
					if ($class === null) {
						continue;
					}

					$name = $parameter->getName();
					$className = $class->getName();
					if (\is_string($params[$name]) && \is_callable([$className, 'fromString'])) {
						$params[$name] = \forward_static_call([$className, 'fromString'], $params[$name]);
					}
				}
			}
		}

		return $params;
	}

	public static function findTemplateFile(
		Component $component,
		string $directory = 'templates',
		string $extension = 'latte'
	): string
	{

		$reflection = $component::getReflection();
		$templatesDir = self::joinFilePath(\dirname($reflection->getFileName()), $directory);

		if ($component instanceof Presenter) {
			[, $name] = Helpers::splitName($component->getName());

			$presenterTemplatesDir = self::joinFilePath($templatesDir, $name);
			if (\file_exists($presenterTemplatesDir)) {
				return self::joinFilePath($presenterTemplatesDir, \sprintf('%s.%s', $component->getView(), $extension));
			}

			return self::joinFilePath($templatesDir, \sprintf('%s.%s', $name, $extension));
		}

		return self::joinFilePath(
			$templatesDir,
			\sprintf('%s.%s', Strings::firstLower($reflection->getShortName()), $extension)
		);
	}

	private static function joinFilePath(string $directory, string $file): string
	{
		return \sprintf('%s/%s', $directory, $file);
	}
}

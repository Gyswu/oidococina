<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\PhpGenerator;

use Nette;
use Nette\Utils\Strings;


/**
 * Generates PHP code.
 */
class Printer
{
	use Nette\SmartObject;

	/** @var string */
	protected $indentation = "\t";

	/** @var int */
	protected $linesBetweenMethods = 2;

	/** @var bool */
	private $resolveTypes = true;


	public function printFunction(GlobalFunction $function, PhpNamespace $namespace = null): string
	{
		return Helpers::formatDocComment($function->getComment() . "\n")
			. 'function '
			. ($function->getReturnReference() ? '&' : '')
			. $function->getName()
			. $this->printParameters($function, $namespace)
			. $this->printReturnType($function, $namespace)
			. "\n{\n" . $this->indent(ltrim(rtrim($function->getBody()) . "\n")) . "}\n";
	}


	public function printClosure(Closure $closure): string
	{
		$uses = [];
		foreach ($closure->getUses() as $param) {
			$uses[] = ($param->isReference() ? '&' : '') . '$' . $param->getName();
		}
		$useStr = strlen($tmp = implode(', ', $uses)) > Helpers::WRAP_LENGTH && count($uses) > 1
			? "\n" . $this->indentation . implode(",\n" . $this->indentation, $uses) . "\n"
			: $tmp;

		return 'function '
			. ($closure->getReturnReference() ? '&' : '')
			. $this->printParameters($closure, null)
			. ($uses ? " use ($useStr)" : '')
			. $this->printReturnType($closure, null)
			. " {\n" . $this->indent(ltrim(rtrim($closure->getBody()) . "\n")) . '}';
	}


	public function printMethod(Method $method, PhpNamespace $namespace = null): string
	{
		$method->validate();
		return Helpers::formatDocComment($method->getComment() . "\n")
			. ($method->isAbstract() ? 'abstract ' : '')
			. ($method->isFinal() ? 'final ' : '')
			. ($method->getVisibility() ? $method->getVisibility() . ' ' : '')
			. ($method->isStatic() ? 'static ' : '')
			. 'function '
			. ($method->getReturnReference() ? '&' : '')
			. $method->getName()
			. ($params = $this->printParameters($method, $namespace))
			. $this->printReturnType($method, $namespace)
			. ($method->isAbstract() || $method->getBody() === null
				? ";\n"
				: (strpos($params, "\n") === false ? "\n" : ' ')
					. "{\n"
					. $this->indent(ltrim(rtrim($method->getBody()) . "\n"))
					. "}\n");
	}


	public function printClass(ClassType $class, PhpNamespace $namespace = null): string
	{
		$class->validate();
		$resolver = $this->resolveTypes && $namespace ? [$namespace, 'unresolveName'] : function ($s) { return $s; };

		$traits = [];
		foreach ($class->getTraitResolutions() as $trait => $resolutions) {
			$traits[] = 'use ' . $resolver($trait)
				. ($resolutions ? " {\n" . $this->indentation . implode(";\n" . $this->indentation, $resolutions) . ";\n}\n" : ";\n");
		}

		$consts = [];
		foreach ($class->getConstants() as $const) {
			$consts[] = Helpers::formatDocComment((string) $const->getComment())
				. ($const->getVisibility() ? $const->getVisibility() . ' ' : '')
				. 'const ' . $const->getName() . ' = ' . Helpers::dump($const->getValue()) . ";\n";
		}

		$properties = [];
		foreach ($class->getProperties() as $property) {
			$properties[] = Helpers::formatDocComment((string) $property->getComment())
				. ($property->getVisibility() ?: 'public') . ($property->isStatic() ? ' static' : '') . ' $' . $property->getName()
				. ($property->getValue() === null ? '' : ' = ' . Helpers::dump($property->getValue()))
				. ";\n";
		}

		$methods = [];
		foreach ($class->getMethods() as $method) {
			$methods[] = $this->printMethod($method, $namespace);
		}

		$members = array_filter([
			implode('', $traits),
			implode('', $consts),
			implode("\n", $properties),
			($methods && $properties ? str_repeat("\n", $this->linesBetweenMethods - 1) : '')
			. implode(str_repeat("\n", $this->linesBetweenMethods), $methods),
		]);

		return Strings::normalize(
			Helpers::formatDocComment($class->getComment() . "\n")
			. ($class->isAbstract() ? 'abstract ' : '')
			. ($class->isFinal() ? 'final ' : '')
			. ($class->getName() ? $class->getType() . ' ' . $class->getName() . ' ' : '')
			. ($class->getExtends() ? 'extends ' . implode(', ', array_map($resolver, (array) $class->getExtends())) . ' ' : '')
			. ($class->getImplements() ? 'implements ' . implode(', ', array_map($resolver, $class->getImplements())) . ' ' : '')
			. ($class->getName() ? "\n" : '') . "{\n"
			. ($members ? $this->indent(implode("\n", $members)) : '')
			. '}'
		) . ($class->getName() ? "\n" : '');
	}


	public function printNamespace(PhpNamespace $namespace): string
	{
		$name = $namespace->getName();

		$uses = [];
		foreach ($namespace->getUses() as $alias => $original) {
			if ($original !== ($name ? $name . '\\' . $alias : $alias)) {
				if ($alias === $original || substr($original, -(strlen($alias) + 1)) === '\\' . $alias) {
					$uses[] = "use $original;";
				} else {
					$uses[] = "use $original as $alias;";
				}
			}
		}

		$classes = [];
		foreach ($namespace->getClasses() as $class) {
			$classes[] = $this->printClass($class, $namespace);
		}

		$body = ($uses ? implode("\n", $uses) . "\n\n" : '')
			. implode("\n", $classes);

		if ($namespace->getBracketedSyntax()) {
			return 'namespace' . ($name ? " $name" : '') . "\n{\n"
				. $this->indent($body)
				. "}\n";

		} else {
			return ($name ? "namespace $name;\n\n" : '')
				. $body;
		}
	}


	public function printFile(PhpFile $file): string
	{
		$namespaces = [];
		foreach ($file->getNamespaces() as $namespace) {
			$namespaces[] = $this->printNamespace($namespace);
		}

		return Strings::normalize(
			"<?php\n"
			. ($file->getComment() ? "\n" . Helpers::formatDocComment($file->getComment() . "\n") : '')
			. "\n"
			. ($file->getStrictTypes() ? "declare(strict_types=1);\n\n" : '')
			. implode("\n\n", $namespaces)
		) . "\n";
	}


	/**
	 * @return static
	 */
	public function setTypeResolving(bool $state = true): self
	{
		$this->resolveTypes = $state;
		return $this;
	}


	protected function indent(string $s): string
	{
		return Strings::indent($s, 1, $this->indentation);
	}


	/**
	 * @param Nette\PhpGenerator\Traits\FunctionLike  $function
	 */
	protected function printParameters($function, ?PhpNamespace $namespace): string
	{
		$params = [];
		$list = $function->getParameters();
		foreach ($list as $param) {
			$variadic = $function->isVariadic() && $param === end($list);
			$hint = $param->getTypeHint();
			$params[] = ($hint ? ($param->isNullable() ? '?' : '') . ($this->resolveTypes && $namespace ? $namespace->unresolveName($hint) : $hint) . ' ' : '')
				. ($param->isReference() ? '&' : '')
				. ($variadic ? '...' : '')
				. '$' . $param->getName()
				. ($param->hasDefaultValue() && !$variadic ? ' = ' . Helpers::dump($param->getDefaultValue()) : '');
		}

		return strlen($tmp = implode(', ', $params)) > Helpers::WRAP_LENGTH && count($params) > 1
			? "(\n" . $this->indentation . implode(",\n" . $this->indentation, $params) . "\n)"
			: "($tmp)";
	}


	/**
	 * @param Nette\PhpGenerator\Traits\FunctionLike  $function
	 */
	protected function printReturnType($function, ?PhpNamespace $namespace): string
	{
		return $function->getReturnType()
			? ': ' . ($function->getReturnNullable() ? '?' : '') . ($this->resolveTypes && $namespace ? $namespace->unresolveName($function->getReturnType()) : $function->getReturnType())
			: '';
	}
}

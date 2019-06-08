<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model\Orm\Orm;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


final class SignInFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;

	/** @var Orm */
	private $orm;


	public function __construct(FormFactory $factory, User $user, Orm $orm)
	{
		$this->factory = $factory;
		$this->user = $user;
		$this->orm = $orm;
	}


	public function create(callable $onSuccess): Form
	{
		$form = $this->factory->create();
		$form->addSelect('username', 'Usuario:', $this->orm->usuarios->findAll()->fetchPairs('id','nombre'))
			->setRequired('Elige tu usuario.');

		$form->addPassword('password', 'Pin:')
			->setRequired('Introduce tu PIN.');

		$form->addCheckbox('remember', 'Mantener sesión');

		$form->addSubmit('send', 'Conectar')->setOption('class', 'btn btn-primary');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			try {
				$this->user->setExpiration($values->remember ? '14 days' : '20 minutes');
				$this->user->login($values->username, $values->password);
			} catch (Nette\Security\AuthenticationException $e) {
				$form->addError('Credenciales incorrectas.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}

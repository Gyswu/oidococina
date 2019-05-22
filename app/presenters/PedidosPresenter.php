<?php


namespace App\Presenters;

use Nette;


class PedidosPresenter extends Nette\Application\UI\Presenter
{



    private $database;

    public function __construct(Nette\Database\Context $database){

        $this->database = $database;
    }
    public function rendermesas(): void
    {
      $this->template->mesas = $this->database->table('mesas')
        ->order('id ASC');
    }
    public function renderplatos(): void
    {
      $this->template->platos = $this->database->table('platos')
        ->order('id ASC');
    }

    public function createComponentMasMesasForm()
    {
      $form = new Form;
      $form->addinteger('id', 'Identificador de la mesa, si no asignas uno, sera asignado solo:');

      $form->addText('nombre', 'Nombre: ')
        ->setRequired();

      $form->addSubmit('send', 'Añadir');

      $form->onSuccess[] = [$this, 'commentFormMasMesas'];
      return $form;



    }
    public function commentFormMasMesas(Form $form, \stdClass $values): void
  {

      $this->database->table('bebidas')->insert([
          'id' => $values->id,
          'nombre' => $values->nombre,
      ]);

      $this->flashMessage('La mesa ha sido añadida a la base de datos', 'success');
      $this->redirect('this');
  }
}

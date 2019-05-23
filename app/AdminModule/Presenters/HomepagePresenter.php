<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;


final class HomepagePresenter extends BaseAdminPresenter

{


    public function renderDefault(){


        //d($this->getMesasModel()->getAll());


    }

  //APARTADO DE MESAS
  public function renderMesas(): void
  {
    $this->template->mesas = $this->getMesasModel()->getAll();

  }

  public function createComponentMasMesasForm(){

    $form = new Form;

    $form->addText('id', 'ID de la mesa: ')
      ->addRule(Form::INTEGER, 'Debe ser un numero entero.');
    $form->addText('nombre', 'Nombre de la mesa')
      ->setRequired();
    $form->addSubmit('send', 'Añadir');

    $form->onSuccess[] = [$this, 'commentFormMasMesas'];
    return $form;

  }

  public function commentFormMasMesas(Form $form, \stdClass $values): void
  {

    $this->database->table('Mesas')->insert([
      'id' => $values->id,
      'nombre' => $values->nombre
    ]);

    $this->flashMessage('La mesa ha sido añadida a la base de datos', 'success');
    $this->redirect('this');

  }
  public function createComponentMenosMesasForm(){

    $form = new Form;

    $form->addinteger('id', 'ID de mesa: ')
      ->setRequired();
    $form->addSubmit('send', 'Eliminar');

    $form->onSuccess[] = [$this, 'commentFormMenosMesas'];
    return $form;

  }
  public function commentFormMenosMesas(Form $form, \stdClass $values): void
  {

    $this->database->table('Mesas')->where('id', $values->id)->delete();

    $this->flashMessage('La mesa ha sido eliminada a la base de datos', 'success');
    $this->redirect('this');

  }

  // APARTADO DE PLATOS
  public function renderPlatos() :void{

      $this->template->platos = $this->getPlatosModel()->getAll();

  }
  public function createComponentMasPlatosForm(){

    $form = new Form;

    $form->addText('nombre', 'Nombre del plato')
      ->setRequired();
    $form->addText('precio', 'Precio del plato')
      ->setRequired()
      ->addRule(Form::FLOAT, 'Debe ser un numero')
      ->setHtmlAttribute("step", '.01');

    $form->addSubmit('send', 'Añadir')
    ->setHtmlAttribute("class", 'btn btn-success');

    $form->onSuccess[] = [$this, 'commentFormMasPlatos'];

    return $form;

  }

  public function commentFormMasPlatos(Form $form): void
  {
    $this->getPlatosModel()->newPlato($form);
      
      //TODO: revisa este código
      $plato = $this->getPlatosModel();
      $plato->nombre = $form->nombre;
      $plato->precio = $form->precio;
      $platoNuevo = $plato->saveNew();
      d($platoNuevo);  
      //TODO: añade aquí algo así como if(isset($platoNuevo->Auto_increment)){flash success}else{flass fail}
      //no sé exactamente cómo se saca el auto increment, pero del dump deberías verlo

    $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');//esto no es cierto, ya que puede dar error y no lo estás revisando si ha sido guardado, deberías mostrar mensaje de error si no se ha guardado
    $this->redirect('this');

  }

  public function createComponentMenosPlatosForm(){

    $form = new Form;

    $form->addText('id', 'IDENTIFICADOR del plato a eliminar')
    ->addRule(Form::INTEGER, 'Debe ser un numero entero')
    ->setRequired();
    $form->addSubmit('send', 'Eliminar')
    ->setHtmlAttribute("class", 'btn btn-danger');

    $form->onSuccess[] = [$this, 'commentFormMenosPlatos'];
    return $form;
  }

  public function commentFormMenosPlatos(Form $form, \stdClass $values): void
  {
    $this->database->table('Platos')->where('id', $values->id)->delete();
    $this->flashMessage('El plato ha sido eliminado de la base de datos', 'success');
    $this->redirect('this');
  }
  // APARTADO DE PRODUCTOS
  public function renderProductos() :void{

      $this->template->platos = $this->getProductosModel()->getAll();

  }
}

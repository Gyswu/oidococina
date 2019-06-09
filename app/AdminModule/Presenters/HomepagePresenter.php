<?php
declare( strict_types = 1 );

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;

final class HomepagePresenter extends BaseAdminPresenter {
    
    //APARTADO DE MESAS
    public function renderdefault(): void {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
    public function createComponentMasMesasForm() {
        
        $form = new Form;
        $form->addText('id', 'ID de la mesa: ')
             ->addRule(Form::INTEGER, 'Debe ser un numero entero.');
        $form->addText('nombre', 'Nombre de la mesa')
             ->setRequired();
        $form->addSubmit('send', 'Añadir');
        $form->onSuccess[] = [ $this, 'commentFormMasMesas' ];
        
        return $form;
    }
    
    public function commentFormMasMesas( Form $form, \stdClass $values ): void {
        
        $this->database->table('Mesas')->insert([
                                                    'id'     => $values->id,
                                                    'nombre' => $values->nombre,
                                                ]);
        $this->flashMessage('La mesa ha sido añadida a la base de datos', 'success');
        $this->redirect('this');
    }
    
    public function createComponentMenosMesasForm() {
        
        $form = new Form;
        $form->addinteger('id', 'ID de mesa: ')
             ->setRequired();
        $form->addSubmit('send', 'Eliminar');
        $form->onSuccess[] = [ $this, 'commentFormMenosMesas' ];
        
        return $form;
    }
    
    public function commentFormMenosMesas( Form $form, \stdClass $values ): void {
        
        $this->database->table('Mesas')->where('id', $values->id)->delete();
        $this->flashMessage('La mesa ha sido eliminada a la base de datos', 'success');
        $this->redirect('this');
    }
    
    // APARTADO DE PRODUCTOS
    public function renderProductos(): void {
        
        $this->template->platos = $this->getProductosModel()->getAll();
    }
}

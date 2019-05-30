<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Menu;
use Nette;
use Nette\Application\UI\Form;

final class MenusFormFactory {
    
    use Nette\SmartObject;
    
    public function createEdit( Menu $menu ) {
        
        $form = $this->create();
        $form->setDefaults($menu->toArray());
        
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre del menu')
             ->setRequired();
        $form->addText('precio', 'Precio del menu')
             ->setRequired()
             ->addRule(Form::FLOAT, 'Debe ser un numero')
             ->setHtmlAttribute("step", '.01');
        $form->addSubmit('send', 'Guardar')
             ->setHtmlAttribute("class", 'btn btn-success');
        
        return $form;
    }
}
<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Mesa;
use Nette;
use Nette\Application\UI\Form;

final class MesasFormFactory {
    
    use Nette\SmartObject;
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre de la mesa')
             ->setRequired();
        $form->addSubmit('send', 'Guardar')
             ->setHtmlAttribute("class", 'btn btn-success');
        
        return $form;
    }
    
    public function createEdit( Mesa $mesa ) {
        
        $form = $this->create();
        $form->setDefaults($mesa->toArray());
        
        return $form;
    }
}

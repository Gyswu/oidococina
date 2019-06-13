<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Categoria;
use Nette;
use Nette\Application\UI\Form;

final class CategoriasFormFactory {
    
    use Nette\SmartObject;
    
    public function createEdit( Categoria $categoria ) {
        
        $form = $this->create();
        $form->setDefaults($categoria->toArray());
        
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre de la categoria')
             ->setRequired();
        $form->addSubmit('send', 'Guardar')
             ->setHtmlAttribute("class", 'btn btn-success');
        
        return $form;
    }
}
<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Plato;
use Nette;
use Nette\Application\UI\Form;

final class PlatosFormFactory {
    
    use Nette\SmartObject;
    
    public function createEdit( Plato $plato, array $categorias ) {
        
        $form = $this->create($categorias);
        $form->setDefaults($plato->toArray());
        
        return $form;
    }
    
    public function create( array $categorias ): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre del plato')
             ->setRequired();
        $form->addText('precio', 'Precio del plato')
             ->setRequired()
             ->addRule(Form::FLOAT, 'Debe ser un numero')
             ->setHtmlAttribute("step", '.01');
        $form->addSelect('category', 'Categoria', $categorias);
        $form->addSubmit('send', 'Guardar')
             ->setHtmlAttribute("class", 'btn btn-success');
        
        return $form;
    }
}

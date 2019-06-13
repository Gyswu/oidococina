<?php
declare( strict_types = 1 );

namespace App\Forms;

use App\Model\Orm\Usuario;
use Nette;
use Nette\Application\UI\Form;

final class UsersFormFactory {
    
    use Nette\SmartObject;
    
    public function createEdit( Usuario $user ) {
        
        $form = $this->create();
        $form->setDefaults($user->toArray());
        
        return $form;
    }
    
    public function create(): Form {
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre de usuario')
             ->setRequired();
        $form->addPassword('pin', 'Codigo pin de usuario')
             ->setRequired()
             ->addRule(Form::INTEGER, 'Debe ser un numero')
             ->addRule(FORM::MIN_LENGTH, 'El pin debe tener 4 digitos', 4)
             ->addRule(FORM::MAX_LENGTH, 'El pin debe tener 4 digitos', 4);
        $form->addSelect('rol', 'Rol', [
            'camarero ' => 'Camarero',
            'tpv'       => 'Tpv',
            'cocinero'  => 'Cocinero',
            'gerente'   => 'Gerente',
            'admin'     => 'Admin',
        ]);
        $form->addSubmit('send', 'Guardar')
             ->setHtmlAttribute("class", 'btn btn-success');
        
        return $form;
    }
}
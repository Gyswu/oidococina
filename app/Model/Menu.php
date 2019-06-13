<?php

namespace App\Model;

use Nette\Security\User;

class Menu {
    
    public static function getMenu( User $user ) {
        
        $menu = [
            [
                'nombre'  => 'Mesas',
                'mostrar' => $user->isAllowed(Roles::SECCION_MESAS),
                'nhref'   => 'Mesas:default',
            ],
            [
                'nombre'  => 'Cocina',
                'mostrar' => $user->isAllowed(Roles::SECCION_COCINA),
                'nhref'   => 'Cocina:default',
            ],
            [
                'nombre'  => 'TPV',
                'mostrar' => $user->isAllowed(Roles::SECCION_TPV),
                'nhref'   => 'Tpv:default',
            ],
            [
                'nombre'  => 'Administración',
                'mostrar' => $user->isAllowed(Roles::SECCION_ADMIN),
                'nhref'   => 'Admin:Homepage:default',
            ],
        ];
        
        return $menu;
    }
    
}

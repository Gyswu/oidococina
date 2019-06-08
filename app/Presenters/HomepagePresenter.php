<?php
declare( strict_types = 1 );

namespace App\Presenters;

final class HomepagePresenter extends BasePresenter {
    
    public function renderDefault() {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    /*
     * Me pregunto si se puede definir que dependiendo del rol un empleado pueda ver una opcion o no.
     *
     * Es decir:
     *
     * OPCIONES EN EL MENU:         | Mesas | Cocina | TPV |
     *                              |       |        |     |
     * Gerente                          x       x       x
     *
     * El del TPV                                       x
     *
     * Cocina                           x       x
     *
     * Camarero                         x
     */
}

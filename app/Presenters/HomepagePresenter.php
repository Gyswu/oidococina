<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\Orm\Plato;

final class HomepagePresenter extends BasePresenter {
    
    public function renderDefault() {

        $ingrediente = $this->orm->ingredientes->findById(1);//->fetchPairs("id", "nombre");
        
        $producto = $this->orm->productos->getById(1);
        d($producto);
        
        dd($ingrediente);
        foreach ($this->orm->platos->getById(1)->productos as $producto) {
            foreach ($producto->platos as $plato) {
                $plato->nombre = 'Judías escozías';
                $this->orm->persistAndFlush($plato);

            }
        }
    }
}

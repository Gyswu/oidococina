<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\Orm\Ingrediente;
use App\Model\Orm\Plato;

final class HomepagePresenter extends BasePresenter {
    
    public function renderDefault() {



        $plato = $this->orm->platos->getById(1);

        $ingrediente = new Ingrediente();
        $ingrediente->cantidad = 10;
        $ingrediente->producto= 3;

        $ingredienteCreado = $this->orm->persist($ingrediente);

        $plato->ingredientes->add($ingredienteCreado);

        dd($this->orm->persistAndFlush($plato));




//
//        $ingrediente = $this->orm->ingredientes->getById(1)->fetchPairs("id", "nombre");
//
//        d($ingrediente->cantidad);
//
//        foreach($ingrediente->platos as $plato){
//            d($plato->nombre);
//        }
//
//
        dd('cut');
//        $producto = $this->orm->productos->getById(1);
//        d($producto);
//
//        dd($ingrediente);
//        foreach ($this->orm->platos->getById(1)->productos as $producto) {
//            foreach ($producto->platos as $plato) {
//                $plato->nombre = 'Judías escozías';
//                $this->orm->persistAndFlush($plato);
//
//            }
//        }
    }
}

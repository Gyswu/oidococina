<?php


namespace App\Model\Database;

use App\Model\Database\Entities\Plato;
use Nette\Application\UI\Form;


class PlatosModel extends BaseModel
{

    /**
     * @return Plato
     */
    public function getEntity()
    {
        return $this->entity;
    }








    public function getAll()
    {
        $all = $this->getDb()->table('Platos')
            ->order('id ASC')
            ->fetchAll();
        return $all;
    }

    public function newPlato(Plato $plato)
    {
        $newPlato = (array)$plato;
        unset($newPlato["id"]);
        return $this->getDb()->table($this->getTableName())->insert($newPlato);
    }

    public function saveNew()
    {
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Platos ?', [ // here can be omitted question mark
            'nombre' => $this->nombre,
            'precio' => $this->precio,
        ]);
    }
    public function getProductos(array $plato)
    {
      //dd($plato);
      return $this->getDb()->query("SELECT p.id, p.nombre, pp.cantidad, p.unidad  FROM Productos p
      join PlatosProductos pp ON p.id = pp.producto AND
      pp.plato = ?",$plato["id"]);
    }


    public function newPlatoProducto(array $newPlatoProducto){
      return $this->getDb()->table('PlatosProductos')->insert($newPlatoProducto);
    }

}

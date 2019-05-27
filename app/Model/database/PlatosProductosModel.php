<?php


namespace App\Model\Database;


use App\Model\Database\Entities\PlatoProducto;

class PlatosProductosModel extends BaseModel
{

    /**
     * @return PlatoProducto
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function getAll() {


        $all=$this->getDb()->table('PlatosProductos')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }

    public function newProducto(PlatoProducto $platoproducto)
    {
        return $this->getDb()->table($this->getTableName())->insert((array)$platoproducto);
    }

    public function saveNew()
    {
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Productos ?', [ // here can be omitted question mark
            'plato' => $this->plato,
            'producto'=> $this->producto,
            'cantidad'=> $this->cantidad,
        ]);
    }

}

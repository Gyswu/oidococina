<?php


namespace App\Model\Database;


use App\Model\Database\Entities\Producto;

class ProductosModel extends BaseModel
{

    /**
     * @return Producto
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function getAll() {


        $all=$this->getDb()->table('Productos')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }

    public function newProducto(Producto $producto)
    {
        return $this->getDb()->table($this->getTableName())->insert((array)$producto);
    }

    public function saveNew()
    {
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Productos ?', [ // here can be omitted question mark
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'cantidad' => $this->cantidad,
            'unidad' => $this->unidad,
        ]);
    }

}

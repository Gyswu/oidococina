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

}

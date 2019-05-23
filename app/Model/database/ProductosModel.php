<?php


namespace App\Model\Database;


class ProductosModel extends BaseModel
{

    public function getAll() {


        $all=$this->getDb()->table('Productos')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }

}

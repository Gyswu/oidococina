<?php


namespace App\Model\Database;


use App\Model\Database\Entities\Mesa;

class PedidosModel extends BaseModel
{

    /**
     * @return Mesa
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function getAll() {


        $all=$this->getDb()->table('Pedidos')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }
    public function newMesa(Pedido $pedido)
    {
        return $this->getDb()->table($this->getTableName())->insert((array)$pedido);
    }

    public function saveNew()
    {
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Pedidos ?', [ // here can be omitted question mark
            'plato' => $this->plato,
            'cantidad' => $this->cantidad,
        ]);
    }

}

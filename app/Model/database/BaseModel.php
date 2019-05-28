<?php

namespace App\Model\Database;

use Nette;

class BaseModel
{

    /** @var Nette\Database\Context $db */
    private $db;

    protected $entity;

    public function __construct(Nette\Database\Context $database)
    {
        $this->db = $database;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setEntity()
    {
        $entity = "App\\Model\\Database\\Entity\\" . $this->getTableName();
        $this->entity = new $entity();
    }

    public function getEntity()
    {
        dd("implement getItem in" . $this->getTableName() . "Model");
    }

    /////////////////////
    /// Base de datos
    public function getTableName()
    {
        $path = explode('\\', get_called_class());
        return str_replace("Model", "", array_pop($path));
    }


    /**
     * @param $where
     * @param $order
     * @param $limit
     * @return Nette\Database\Table\Selection
     */
    private function find($where = null, $order = null, $limit = null)
    {
        $result = $this->db->table($this->getTableName())->select("*");

        if ($where)
            $result->where($where);
        if ($order)
            $result->order($order);
        if ($limit)
            $result->limit($limit);

        return $result;
    }

    /**
     * Devuelve todas las filas
     *
     * @param $where
     * @param $order
     * @param $limit
     * @return [] Nette\Database\Table\ActiveRow
     */
    public function findAll($where = null, $order = null, $limit = null)
    {
        return $this->find($where, $order, $limit)->fetchAll();
    }

    /**
     * Devuelve una única fila por condición
     *
     * @param $where
     * @return Nette\Database\IRow|Nette\Database\Table\ActiveRow|null
     */
    public function findOne($where)
    {
        return $this->find($where, null, 1)->fetch();
    }

    /**
     * Devuelve una única fila por su id
     *
     * @param $id
     * @return Nette\Database\Table\ActiveRow
     */
    public function findById($id)
    {
        return $this->find(['id' => $id], null, 1)->fetch();
    }

    /**
     * Devuelve array key=>value con el resultado de la consulta
     *
     * @param $key
     * @param $value
     * @param $where
     * @param $order
     * @param $limit
     * @return array
     */
    public function findAllPairs($key, $value, $where=null, $order=null, $limit=null)
    {
        return $this->find($where, $order, $limit)->fetchPairs($key, $value);
    }

    ///
    //////////////////////


}

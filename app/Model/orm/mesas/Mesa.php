<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Plato
 *
 * @property int $id             {primary}
 * @property string $nombre
 */
class Mesa extends Entity
{

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}
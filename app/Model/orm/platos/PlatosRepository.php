<?php

namespace App\Model\Orm;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * @method Plato|NULL getById($id)
 */
class PlatosRepository extends Repository {
    
    public function getShit() {
        dd('caca');
    }
    
    public function findHomepageOverview() {
        return $this->findAll()->orderBy('createdAt', ICollection::DESC);
    }
    
    static function getEntityClassNames(): array {
        return [Plato::class];
    }
}
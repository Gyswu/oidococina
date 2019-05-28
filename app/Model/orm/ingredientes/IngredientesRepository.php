<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Ingrediente|NULL getById($id)
 */
class IngredientesRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [Ingrediente::class];
    }
}
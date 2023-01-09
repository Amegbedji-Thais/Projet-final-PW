<?php

namespace App\Faker;

use Faker\Provider\Base;

class BiensProvider extends Base
{

    //Classe que j'utilise pour la définitions de constantes. Utilisé dans le formulaire de recherhce multiple.
    const TYPE = [
      'Location',
      'Vente'
    ];

    public function biensType() {
        return self::randomElement(self::TYPE);
    }
}
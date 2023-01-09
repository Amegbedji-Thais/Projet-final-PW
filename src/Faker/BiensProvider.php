<?php

namespace App\Faker;

use Faker\Provider\Base;

class BiensProvider extends Base
{
    const TYPE = [
      'Location',
      'Vente'
    ];

    public function biensType() {
        return self::randomElement(self::TYPE);
    }
}
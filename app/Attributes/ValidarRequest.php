<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class ValidarRequest {
    public function __construct(
        public string $classe,
        public string $parametros
    )
    {
        
    }
}
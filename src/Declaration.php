<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst;


class Declaration
{
    public $declarationId;

    public $paymentReference;

    public function __construct($declarationId, $paymentReference)
    {

        $this->declarationId = $declarationId;
        $this->paymentReference = $paymentReference;
    }
}

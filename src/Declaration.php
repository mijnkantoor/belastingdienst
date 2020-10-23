<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst;


class Declaration
{
    public const IBAN = 'NL86INGB0002445588';
    public $declarationId;
    public $paymentReference;
    public $paymentDueDate;

    public function __construct($declarationId, $paymentReference, $paymentDueDate)
    {

        $this->declarationId = $declarationId;
        $this->paymentReference = $paymentReference;
        $this->paymentDueDate = $paymentDueDate;
    }

    public function getFormattedIban(): string
    {
        return sprintf('%2s %2d %4s %4s %4s %2s',
            substr(self::IBAN, 0, 2),
            substr(self::IBAN, 2, 2),
            substr(self::IBAN, 4, 4),
            substr(self::IBAN, 8, 4),
            substr(self::IBAN, 12, 4),
            substr(self::IBAN, 16, 2));
    }

    public function getFormattedPaymentReference(): string
    {
        return implode('.', str_split($this->paymentReference, 4));
    }
}

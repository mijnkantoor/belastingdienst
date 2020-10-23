<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst\Exceptions;

class PeriodException extends \RuntimeException
{
    public static function invalidPeriod()
    {
        return new self(sprintf('Invalid period'));
    }

}

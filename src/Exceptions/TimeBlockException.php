<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst\Exceptions;

class TimeBlockException extends \RuntimeException
{
    public static function invalidYear($year)
    {
        return new self(sprintf('Invalid year %s', $year));
    }

}

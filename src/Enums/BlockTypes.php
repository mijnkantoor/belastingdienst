<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst\Enums;

use MyCLabs\Enum\Enum;

final class BlockTypes extends Enum
{
    public const MONTLY = 'monthly';
    public const FOURWEEK = 'fourweek';
    public const HALFYEAR = 'halfyear';
    public const YEARLY = 'yearly';
}

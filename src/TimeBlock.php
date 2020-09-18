<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst;


use Mijnkantoor\Belastingdienst\Enums\BlockTypes;
use Mijnkantoor\Belastingdienst\Enums\DeclarationTypes;
use Mijnkantoor\Belastingdienst\Exceptions\DeclarationException;
use Mijnkantoor\Belastingdienst\Exceptions\TimeBlockException;

class TimeBlock
{
    protected $year;

    /**
     * @var DeclarationTypes
     */
    protected $type;
    /**
     * @var BlockTypes
     */
    protected $block;
    /**
     * @var int
     */
    private $period;

    public function __construct(DeclarationTypes $type, int $year, BlockTypes $block, int $period)
    {
        if ($year < 1990 || $year > 2100) {
            throw TimeBlockException::invalidYear($year);
        }

        $this->year = $year;
        $this->type = $type;
        $this->block = $block;
        $this->period = $period;
    }

    public function getYearCode(): int
    {
        return (int)((string)$this->year)[- 1];
    }

    public function getTypeLetter(): string
    {
        switch ($this->type->getValue()) {
            case DeclarationTypes::LOAN:
                return 'L';
        }

        throw DeclarationException::notSupported($this->type);
    }

    public function getTypeCode(): int
    {
        switch ($this->type->getValue()) {
            case DeclarationTypes::LOAN:
                return 6;
        }

        throw DeclarationException::notSupported($this->type);
    }

    public function createTimeCode(): string
    {
        return sprintf('%1d%2s0',
            $this->getYearCode(),
            $this->getPeriodCode()
        );
    }

    public function getPeriodCode(): string
    {
        switch ($this->type->getValue()) {
            case DeclarationTypes::LOAN:
                return $this->getPeriodCodeForLoan();
        }

        throw DeclarationException::notSupported($this->type);
    }

    public function getPeriodCodeForLoan(): string
    {
        switch ($this->block->getValue()) {
            case BlockTypes::MONTLY:
                return str_pad((string)$this->period, 2, '0', STR_PAD_LEFT);
            case BlockTypes::FOURWEEK:
                return $this->period >= 10 ? "8" . $this->period[- 1] : "7" . $this->period[- 1];
            case BlockTypes::HALFYEAR:
                return "3" . $this->period;
            case BlockTypes::YEARLY:
                return "40";
        }
    }
}

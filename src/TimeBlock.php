<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst;


use Carbon\Carbon;
use Mijnkantoor\Belastingdienst\Enums\BlockTypes;
use Mijnkantoor\Belastingdienst\Enums\DeclarationTypes;
use Mijnkantoor\Belastingdienst\Exceptions\DeclarationException;
use Mijnkantoor\Belastingdienst\Exceptions\TimeBlockException;

class TimeBlock
{
    /**
     * @var int
     */
    protected $month;
    /**
     * @var int
     */
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
    protected $period;
    /**
     * @var Carbon
     */
    protected $from;
    /**
     * @var Carbon
     */
    protected $till;


    /**
     * TimeBlock constructor.
     * @param DeclarationTypes $type
     * @param int $year
     * @param int $month
     * @param BlockTypes $block
     * @param int $period
     * @param Carbon $from
     * @param Carbon $till
     */
    public function __construct(DeclarationTypes $type, int $year, int $month, BlockTypes $block, int $period, Carbon $from, Carbon $till)
    {
        if ($year < 1990 || $year > 2100) {
            throw TimeBlockException::invalidYear($year);
        }

        $this->year = $year;
        $this->month = $month;
        $this->type = $type;
        $this->block = $block;
        $this->period = $period;
        $this->from = $from;
        $this->till = $till;
    }

    public function getTypeLetter(): string
    {
        switch ($this->type->getValue()) {
            case DeclarationTypes::LOAN:
                return 'L';
            case DeclarationTypes::REVENUE:
                return 'B';
        }

        throw DeclarationException::notSupported($this->type);
    }

    public function getTypeCode(): int
    {
        switch ($this->type->getValue()) {
            case DeclarationTypes::LOAN:
                return 6;
            case DeclarationTypes::REVENUE:
                return 1;
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

    public function getYearCode(): int
    {
        return (int)((string)$this->year)[- 1];
    }

    public function getPeriodCode(): string
    {
        switch ($this->type->getValue()) {
            case DeclarationTypes::LOAN:
                return $this->getPeriodCodeForLoan();
            case DeclarationTypes::REVENUE:
                return $this->getPeriodCodeForRevenue();
        }

        throw DeclarationException::notSupported($this->type);
    }

    public function getPeriodCodeForLoan(): string
    {
        switch ($this->block->getValue()) {
            case BlockTypes::MONTHLY:
                return str_pad((string)$this->period, 2, '0', STR_PAD_LEFT);
            case BlockTypes::FOURWEEK:
                return $this->period >= 10 ? "8" . ((string)$this->period)[- 1] : "7" . $this->period;
            case BlockTypes::HALFYEAR:
                return "3" . $this->period;
            case BlockTypes::YEARLY:
                return "40";
        }
    }

    public function getPeriodCodeForRevenue(): string
    {
        switch ($this->block->getValue()) {
            case BlockTypes::MONTHLY:
                return str_pad((string)$this->period, 2, '0', STR_PAD_LEFT);
            case BlockTypes::QUARTER:
                return (string)((int)$this->month + 20);
            case BlockTypes::YEARLY:
                return "40";
        }
    }

    /**
     * @return BlockTypes
     */
    public function getBlock(): BlockTypes
    {
        return $this->block;
    }

    /**
     * @param BlockTypes $block
     */
    public function setBlock(BlockTypes $block): void
    {
        $this->block = $block;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @return Carbon
     */
    public function getFrom(): Carbon
    {
        return $this->from;
    }

    /**
     * @return Carbon
     */
    public function getTill(): Carbon
    {
        return $this->till;
    }

    /**
     * @return DeclarationTypes
     */
    public function getType(): DeclarationTypes
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }
}

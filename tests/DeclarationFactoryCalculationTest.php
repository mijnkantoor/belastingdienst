<?php

use Carbon\Carbon;

class DeclarationFactoryCalculationTest extends \PHPUnit\Framework\TestCase
{
    public function testBlockCalculations()
    {
        $factory = new \Mijnkantoor\Belastingdienst\DeclarationFactory();

        //Months
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new Carbon('01-01-2020'), new Carbon('31-01-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new Carbon('01-02-2020'), new Carbon('29-02-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new Carbon('01-03-2020'), new Carbon('31-03-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new Carbon('01-04-2020'), new Carbon('30-04-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new Carbon('01-05-2020'), new Carbon('31-05-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new Carbon('01-06-2020'), new Carbon('30-06-2020'))
        );

        //Four weeks
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(),
            $factory->calculateBlock(new Carbon('01-01-2020'), new Carbon('26-01-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(),
            $factory->calculateBlock(new Carbon('27-01-2020'), new Carbon('23-02-2020'))
        );

        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(),
            $factory->calculateBlock(new Carbon('30-11-2020'), new Carbon('31-12-2020'))
        );

        //Half year
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(),
            $factory->calculateBlock(new Carbon('01-01-2020'), new Carbon('30-06-2020'))
        );

        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(),
            $factory->calculateBlock(new Carbon('01-07-2020'), new Carbon('31-12-2020'))
        );

        //Year
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::YEARLY(),
            $factory->calculateBlock(new Carbon('01-01-2020'), new Carbon('31-12-2020'))
        );

    }

    public function testPeriodCalculations()
    {
        $factory = new \Mijnkantoor\Belastingdienst\DeclarationFactory();

        //Months
        $this->assertEquals(
            1,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(), new Carbon('01-01-2020'), new Carbon('31-01-2020'))
        );
        $this->assertEquals(
            2,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(), new Carbon('01-02-2020'), new Carbon('29-02-2020'))
        );
        $this->assertEquals(
            3,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(), new Carbon('01-03-2020'), new Carbon('31-03-2020'))
        );
        $this->assertEquals(
            4,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(), new Carbon('01-04-2020'), new Carbon('30-04-2020'))
        );
        $this->assertEquals(
            5,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(), new Carbon('01-05-2020'), new Carbon('31-05-2020'))
        );
        $this->assertEquals(
            6,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(), new Carbon('01-06-2020'), new Carbon('30-06-2020'))
        );

        //Four weeks
        $this->assertEquals(
            1,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(), new Carbon('01-01-2020'), new Carbon('26-01-2020'))
        );

        $this->assertEquals(
            2,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(), new Carbon('27-01-2020'), new Carbon('23-02-2020'))
        );

        $this->assertEquals(
            3,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(), new Carbon('24-02-2020'), new Carbon('22-03-2020'))
        );

        $this->assertEquals(
            13,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(), new Carbon('30-11-2020'), new Carbon('31-12-2020'))
        );

        //Half year
        $this->assertEquals(
            1,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(), new Carbon('01-01-2020'), new Carbon('30-06-2020'))
        );

        $this->assertEquals(
            2,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(), new Carbon('01-07-2020'), new Carbon('31-12-2020'))
        );

        //Year
        $this->assertEquals(
            0,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::YEARLY(), new Carbon('01-01-2020'), new Carbon('31-12-2020'))
        );

    }
}

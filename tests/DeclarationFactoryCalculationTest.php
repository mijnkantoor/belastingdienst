<?php


class DeclarationFactoryCalculationTest extends \PHPUnit\Framework\TestCase
{
    public function test4WeekCalculations()
    {
        $factory = new \Mijnkantoor\Belastingdienst\DeclarationFactory();

        //Months
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new DateTime('01-01-2020'), new DateTime('31-01-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new DateTime('01-02-2020'), new DateTime('29-02-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new DateTime('01-03-2020'), new DateTime('31-03-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new DateTime('01-04-2020'), new DateTime('30-04-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new DateTime('01-05-2020'), new DateTime('31-05-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::MONTHLY(),
            $factory->calculateBlock(new DateTime('01-06-2020'), new DateTime('30-06-2020'))
        );

        //Four weeks
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(),
            $factory->calculateBlock(new DateTime('01-01-2020'), new DateTime('26-01-2020'))
        );
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(),
            $factory->calculateBlock(new DateTime('27-01-2020'), new DateTime('23-02-2020'))
        );

        //Half year
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(),
            $factory->calculateBlock(new DateTime('01-01-2020'), new DateTime('30-06-2020'))
        );

        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(),
            $factory->calculateBlock(new DateTime('01-07-2020'), new DateTime('31-12-2020'))
        );

        //Year
        $this->assertEquals(
            \Mijnkantoor\Belastingdienst\Enums\BlockTypes::YEARLY(),
            $factory->calculateBlock(new DateTime('01-01-2020'), new DateTime('31-12-2020'))
        );

    }
}

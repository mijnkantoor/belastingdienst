<?php

use Carbon\Carbon;
use Mijnkantoor\Belastingdienst\Enums\DeclarationTypes;

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

        $this->assertEquals(
            1,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::FOURWEEK(), new Carbon('01-01-2021'), new Carbon('31-01-2021'))
        );

        //Half year
        $this->assertEquals(
            1,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(), new Carbon('01-01-2020'), new Carbon('30-06-2020'))
        );

        $this->assertEquals(
            1,
            $factory->calculatePeriod(\Mijnkantoor\Belastingdienst\Enums\BlockTypes::HALFYEAR(), new Carbon('01-01-2021'), new Carbon('26-12-2021'))
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

    public function testLoanNumber()
    {
        $factory = new \Mijnkantoor\Belastingdienst\DeclarationFactory();

        $periods = [
            'loan' => [
                // half year
                ['01-01-2010', '30-06-2010', '001000019L01', '2001000016001310', '31-07-2010'],
                ['01-07-2010', '31-12-2010', '001000019L01', '9001000016001320', '31-01-2011'],

                // month
                ['01-01-2016', '31-01-2016', '001000032L02', '5001000036602010', '29-02-2016'],
                ['01-12-2021', '31-12-2021', '001000330L07', '6001000336107120', '31-01-2022'],
                ['01-08-2022', '31-08-2022', '001000147L10', '4001000146210080', '30-09-2022'],

                // 4week
                ['01-01-2020', '26-01-2020', '001000330L07', '4001000336007710', '26-02-2020'],
                ['27-01-2020', '23-02-2020', '001000330L07', '0001000336007720', '23-03-2020'],
                ['13-07-2020', '09-08-2020', '001000330L07', '9001000336007780', '09-09-2020'],
                ['30-11-2020', '31-12-2020', '001000330L07', '1001000336007830', '31-01-2021'],
                ['07-09-2020', '04-10-2020', '857256476L01', '0857256476001800', '04-11-2020'],
                ['01-01-2021', '31-01-2021', '857256476L01', '6857256476101710', '04-11-2020'],

                // year
                ['01-01-2020', '31-12-2020', '001000330L07', '1001000336007400', '31-01-2021'],
            ],
            'revenue' => [
                // month
                ['01-01-2016', '31-01-2016', '001000019B01', '7001000011601010', '29-02-2016'],
                ['01-12-2021', '31-12-2021', '001000019B01', '7001000011101120', '31-01-2022'],
                ['01-08-2022', '31-08-2022', '001000019B01', '4001000011201080', '30-09-2022'],

                // shifted quarter
                ['01-02-2020', '30-04-2020', '001000019B01', '8001000011001220', '31-05-2020'],
                ['01-03-2020', '31-05-2020', '001000019B01', '4001000011001230', '30-06-2020'],
                ['01-09-2020', '30-11-2020', '001000019B01', '2001000011001290', '31-12-2020'],

                // normal quarter
                ['01-01-2020', '31-03-2020', '001000019B01', '1001000011001210', '30-04-2020'],
                ['01-04-2020', '30-06-2020', '001000019B01', '0001000011001240', '31-07-2020'],
                ['01-07-2020', '30-09-2020', '001000019B01', '1001000011001270', '31-10-2020'],
                ['01-10-2020', '31-12-2020', '001000019B01', '8001000011001300', '31-01-2021'],

                // year
                ['01-01-2020', '31-12-2020', '001000019B01', '0001000011001400', '31-01-2021'],
            ]
        ];

        foreach ($periods as $decType => $testRules) {
            foreach ($testRules as $testRule) {

                $declaration = $factory->createFromDeclarationIdAndDateRange(
                    new DeclarationTypes($decType),
                    $testRule[2],
                    new Carbon($testRule[0]),
                    new Carbon($testRule[1])
                );

                $this->assertEquals($declaration->paymentReference, $testRule[3]);
                $this->assertEquals($declaration->paymentDueDate->format('d-m-Y'), $testRule[4]);
            }
        }
    }

}

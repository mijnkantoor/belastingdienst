<?php

declare(strict_types=1);

namespace Mijnkantoor\Belastingdienst;

class DeclarationFactory
{
    public function create($id, TimeBlock $timeBlock)
    {
        $identifier = substr($id, 0, 9);
        $subCode = substr($id, 10, 2);

        //Composite declaration id
        $declarationId = sprintf('%d.%s.%s.%s',
            $identifier,
            $timeBlock->getTypeLetter(),
            $subCode,
            $timeBlock->createTimeCode()
        );


        $strippedDeclarationId = str_replace('.', '', $declarationId);

        //Composite the payment reference
        $paymentReference = sprintf('0%s%s%s%s%s',
            substr($strippedDeclarationId, 0, 8),
            $timeBlock->getTypeCode(),
            $strippedDeclarationId[12],
            substr($strippedDeclarationId, 10, 2),
            substr($strippedDeclarationId, 13, 3)
        );

        //Calculate control number
        $controlNumber = $this->validatePaymentReferenceNetherlands($paymentReference);

        //Substitude control number
        $paymentReference[0] = $controlNumber;

        return new Declaration($declarationId, $paymentReference);
    }

    private function validatePaymentReferenceNetherlands($value)
    {
        $number = substr($value, (strlen($value) === 16 ? 1 : 2));

        if (strlen($number) < 15) {
            $number = str_pad($number, 15, '0', STR_PAD_LEFT);
        }

        $sum = 0;
        $sum += $number[strlen($number) - 1] * 2;
        $sum += $number[strlen($number) - 2] * 4;
        $sum += $number[strlen($number) - 3] * 8;
        $sum += $number[strlen($number) - 4] * 5;
        $sum += $number[strlen($number) - 5] * 10;
        $sum += $number[strlen($number) - 6] * 9;
        $sum += $number[strlen($number) - 7] * 7;
        $sum += $number[strlen($number) - 8] * 3;
        $sum += $number[strlen($number) - 9] * 6;
        $sum += $number[strlen($number) - 10] * 1;
        $sum += $number[strlen($number) - 11] * 2;
        $sum += $number[strlen($number) - 12] * 4;
        $sum += $number[strlen($number) - 13] * 8;
        $sum += $number[strlen($number) - 14] * 5;
        $sum += $number[strlen($number) - 15] * 10;

        $check = 11 - ($sum % 11);

        return $check == 10 ? 1 : ($check == 11 ? 0 : $check);
    }

}

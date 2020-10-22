<?php

class IBANTest extends \PHPUnit\Framework\TestCase
{
    public function testIbanTampering()
    {
        $site = file_get_contents('https://www.belastingdienst.nl/wps/wcm/connect/nl/contact/content/alle-rekeningnummers-van-de-belastingdienst');

        $this->assertNotFalse(strpos($site, \Mijnkantoor\Belastingdienst\Declaration::IBAN));
    }
}

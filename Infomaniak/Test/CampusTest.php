<?php

namespace Infomaniak\Test;

use Infomaniak\Campus;

class CampusTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetCityWithInvalidValues($value) {
        $campus = new Campus();

        $campus->setCity($value);
    }


    /**
     * @dataProvider cityProviderValidValues
     */
    public function testSetCityWithValidValues($expected) {
        $campus = new Campus();

        $campus->setCity($expected);
        $value = $campus->getCity();

        $this->assertEquals($expected, $value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetRegionWithInvalidValues($value) {
        $campus = new Campus();

        $campus->setRegion($value);
    }


    /**
     * @dataProvider regionProviderValidValues
     */
    public function testSetRegionWithValidValues($expected) {
        $campus = new Campus();

        $campus->setRegion($expected);
        $value = $campus->getRegion();

        $this->assertEquals($expected, $value);
    }



    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetCapacityWithInvalidValues($value) {
        $campus = new Campus();

        $campus->setCapacity($value);
    }


    public function testSetCapacityWithValidValues() {
        $campus = new Campus();

        for ($i = 10; $i >= -10; --$i) {
            $campus->setCapacity($i);
            $capacity = $campus->getCapacity();
            if ($i > 0) {
                $this->assertEquals($i, $capacity);
            } else {
                $this->assertEquals(0, $capacity);
            }
        }
    }



    //--------------------------------------------------------------------------
    // Providers
    //--------------------------------------------------------------------------

    /**
     * Des noms de villes correctes
     */
    public function cityProviderValidValues() {
        return array(
            // Ville vide
            array(""),

            // Villes
            array("Orange"),       // Test basique
            array("Béziers"),      // Accents
            array("Екатеринбург"), // Cyrillique (Iekaterinbourg)
            array("東京都"),        // Kanji (Tokyo)
        );
    }


    /**
     * Des noms de régions correctes
     */
    public function regionProviderValidValues() {
        return array(
            // Région vide
            array(""),

            // Région
            array("Gard"),                        // Test basique
            array("Hérault"),                     // Accents
            array("Уральский федеральный округ"), // Cyrillique (District fédéral de l'Oural)
            array("関東地方"),                     // Kanji (Kantō)
        );
    }


    /**
     * Des machins qui ne sont pas des strings
     */
    public function providerNotStrings() {
        return Helpers::providerNotStrings();
    }


    /**
     * Des machins qui ne sont pas des entiers
     */
    public function providerNotInts() {
        return Helpers::providerNotInts();
    }
}
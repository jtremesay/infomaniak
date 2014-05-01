<?php

namespace Infomaniak\Test;

class Helpers {
    /**
     * Des machins qui ne sont pas des strings
     */
    static public function providerNotStrings() {
        return array(
            array(255),
            array(0xff),
            array(255.0),
            array(true),
            array(false),
            array(null),
            array(array()),
            array(new \DateTime()),
        );
    }

    /**
     * Des machins qui ne sont pas des entiers
     */
    static public function providerNotInts() {
        return array(
            array("Zébulon"),
            array(255.0),
            array(true),
            array(false),
            array(null),
            array(array()),
            array(new \DateTime()),
        );
    }
}
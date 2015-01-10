<?php

namespace Infomaniak\Test;

class Helpers {
    /**
     * Des machins qui ne sont pas des strings
     */
    static public function providerNotStrings() {
        return [
            [255],
            [0xff],
            [255.0],
            [true],
            [false],
            [null],
            [[]],
            [new \DateTime()],
        ];
    }

    /**
     * Des machins qui ne sont pas des entiers
     */
    static public function providerNotInts() {
        return [
            ["Zébulon"],
            [255.0],
            [true],
            [false],
            [null],
            [[]],
            [new \DateTime()],
        ];
    }
}
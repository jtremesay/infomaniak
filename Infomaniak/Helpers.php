<?php

namespace Infomaniak;


class Helpers {
    /**
     * Supprime un élément d'un tableau
     *
     * @param array $haystack Le tableau
     * @param mixed $needle La valeur
     * @return array
     */
    static function array_remove($haystack, $needle) {
        $index = array_search($needle, $haystack);
        if ($index !== false) {
            $haystack = array_merge(
                array_slice($haystack, $index + 1),
                array_slice($haystack, 0, $index)
            );
        }

        return $haystack;
    }


    /**
     * Clone un tableau en profondeur
     *
     * @param array $array Le tableau
     * @return array
     */
    static function array_clone($array) {
        return array_map(function($element) {
            return (
                ((is_array($element))
                    ? call_user_func(__FUNCTION__, $element)
                    : ((is_object($element))
                        ? clone $element
                        : $element
                    )
                )
            );
        }, $array);
    }
}

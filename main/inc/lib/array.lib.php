<?php
/* For licensing terms, see /license.txt */
/**
*	This is the array library for Chamilo.
*	Include/require it in your code to use its functionality.
*
*	@package chamilo.library
*/

class ArrayClass {


    /**
     * Removes duplicate values from a dimensional array
     *
     * @param array a dimensional array
     * @return array an array with unique values
     *
     */
    static function array_unique_dimensional($array) {
        if(!is_array($array))
            return $array;

        foreach ($array as &$myvalue) {
            $myvalue=serialize($myvalue);
        }

        $array=array_unique($array);

        foreach ($array as &$myvalue) {
            $myvalue=unserialize($myvalue);
        }
        return $array;
    }

    /**
     *
     * Sort multidimensional arrays
     *
     * @param 	array 	unsorted multidimensional array
     * @param 	string	key to be sorted
     * @return 	array	result array
     * @author	found in http://php.net/manual/en/function.sort.php
     */
    static function msort($array, $id='id', $order = 'desc') {
        if (empty($array)) {
            return $array;
        }
        $temp_array = array();
        while (count($array)>0) {
            $lowest_id = 0;
            $index=0;
            foreach ($array as $item) {
                if ($order == 'desc') {
                    if ($item[$id]<$array[$lowest_id][$id]) {
                        $lowest_id = $index;
                    }
                } else {
                    if ($item[$id]>$array[$lowest_id][$id]) {
                        $lowest_id = $index;
                    }
                }
                $index++;
            }
            $temp_array[] = $array[$lowest_id];
            $array = array_merge(array_slice($array, 0, $lowest_id), array_slice($array, $lowest_id+1));
        }
        return $temp_array;
    }

    static function utf8_sort($array) {
        $old_locale = setlocale(LC_ALL, null);
        $code = api_get_language_isocode();
        $locale_list = array($code.'.utf8', 'en.utf8','en_US.utf8','en_GB.utf8');
        $try_sort = false;

        foreach($locale_list as $locale) {
            $my_local = setlocale(LC_COLLATE, $locale);
            if ($my_local) {
                $try_sort = true;
                break;
            }
        }

        if ($try_sort) {
            uasort($array, 'strcoll');
        }
        setlocale(LC_COLLATE, $old_locale);
        return $array;
    }

    static function array_to_string($array, $separator = ',') {
        if (empty($array)) {
            return '';
        }
        return implode($separator.' ', $array);
    }

    static function array_flatten(array $array) {
        $flatten = array();
        array_walk_recursive($array, function($value) use(&$flatten) {
            $flatten[] = $value;
        });
        return $flatten;
    }
}
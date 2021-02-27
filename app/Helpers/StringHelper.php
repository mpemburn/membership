<?php

namespace App\Helpers;

use App\Objects\PhoneParser;

/**
 * Class StringHelper
 * @package Theme\Helpers
 */
class StringHelper
{
    /**
     * hasSubstringInArray
     *
     * Tests if needle is found in an array of haystack items
     *
     * @param $needle
     * @param array $haystack
     * @return bool
     */
    public static function hasSubstringInArray($needle, array $haystack): bool
    {
        $found = false;
        foreach ($haystack as $test) {
            if (strpos( $needle, $test) !== false) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    /**
     * @param $string
     * @return string ("a" or "an" as appropriate for the value of $string)
     */
    public static function properArticle($string): string
    {
        return in_array(
            strtolower(substr($string, 0 , 1)),
            str_split('aeiou'), true) ? 'an' : 'a';

    }

    /**
     * @param $line1
     * @param $line2
     * @param $city
     * @param $state
     * @param $zip
     * @return string
     */
    public static function formatAddressLine($line1, $line2, $city, $state, $zip)
    {
        $addressLineTwo = (!is_null($line2)) ? $line2 . ' ' : '';

        return $line1 . ' ' . $addressLineTwo . ' / ' . $city . ', ' . $state . ' ' . $zip;

    }

    /**
     * @param $string
     * @return string
     */
    public static function pluralize($string)
    {
        $exceptions = ['ch', 's', 'sh', 'x', 'z'];

        foreach ($exceptions as $exception) {
            if ($string[strlen($string) - 1] == $exception) {
                return $string . 'es';
            }
        }

        return $string . 's';
    }

    /**
     * @param $inString
     * @param array $variables
     * @param string $startDelim
     * @param string $endDelim
     * @return null|string|string[]
     */
    public static function replaceVars($inString, array $variables, $startDelim = '{{{', $endDelim = '}}}')
    {
        $outString = preg_replace_callback('/' . $startDelim . '(.+?)' . $endDelim . '/ix', function ($match) use ($variables) {
            return !empty($variables[$match[1]]) ? $variables[$match[1]] : $match[0];
        }, $inString);

        return $outString;
    }

    /**
     * @param $snake
     * @return string
     */
    public static function toPascalCase($snake)
    {
        return implode('',array_map('ucfirst',explode('_',$snake)));
    }

    /**
     * @param $snake
     * @return string
     */
    public static function toCamelCase($snake)
    {
        return lcfirst(self::toPascalCase($snake));
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    public static function stripHtmlTags($string)
    {
        return preg_replace('/<[^>]*>/', '', $string);
    }

}

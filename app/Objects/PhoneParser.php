<?php

namespace App\Objects;

class PhoneParser
{
    public ?string $ext = null;

    public function __construct()
    {

    }

    public function parse(?string $phoneString): ?string
    {
        if (stripos($phoneString, 'x') !== false) {
            $extPattern = '/(.*)( x|ext)(.*)/';
            $testString = $phoneString;
            $phoneString = trim(preg_replace($extPattern, '$1', $phoneString));
            $this->ext = trim(preg_replace($extPattern, '$3', $testString));
        }

        if (! empty($phoneString)) {
            $pattern = '/\+?1?\s*\(?-*\.*(\d{3})\)?\.*-*\s*(\d{3})\.*-*\s*(\d{4})$/';

            preg_match_all($pattern, $phoneString, $matches);
            $parts = collect($matches)->flatten();
            if ($parts->isNotEmpty()) {
                $parts->shift();
                $areaCode = $parts->shift();
                $prefix = $parts->shift();
                $lineNumber = $parts->shift();

                return "({$areaCode}) {$prefix}-{$lineNumber}";
            }
        }


        return null;
    }

    public function getExtension(): ?string
    {
        return trim($this->ext);
    }
}

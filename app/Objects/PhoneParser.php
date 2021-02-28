<?php

namespace App\Objects;

use Illuminate\Support\Collection;

class PhoneParser
{
    protected const MASK_ELEMENTS = ['[\?]{3}', '[\?]{3}', '[\?]{4}'];
    public Collection $phoneParts;
    public Collection $maskParts;
    public ?string $extension = null;
    public ?string $areaCode = null;
    public ?string $prefix = null;
    public ?string $lineNumber = null;

    public function __construct()
    {
        $this->phoneParts = collect();
        $this->maskParts = collect(self::MASK_ELEMENTS);
    }

    public function parse(?string $phoneString): self
    {
        if (stripos($phoneString, 'x') !== false) {
            $phoneString = $this->setExtension($phoneString);
        }

        if (! empty($phoneString)) {
            $pattern = '/\+?1?\s*\(?-*\.*(\d{3})\)?\.*-*\s*(\d{3})\.*-*\s*(\d{4})$/';

            preg_match_all($pattern, $phoneString, $matches);
            $this->phoneParts = collect($matches)->flatten()->reject($phoneString);
        }

        return $this;
    }

    protected function setExtension(?string $phoneString): ?string
    {
        $testString = $phoneString;
        $extPattern = '/(.*)( x|ext)(.*)/';

        $phoneString = trim(preg_replace($extPattern, '$1', $phoneString));
        $this->extension = trim(preg_replace($extPattern, '$3', $testString));

        return $phoneString;
    }

    public function format($formatString = '(???) ???-????'): ?string
    {
        if ($this->phoneParts->isEmpty()) {
            return null;
        }

        $this->maskParts->each(function ($maskString) use (&$formatString) {
            $pattern = '/' . $maskString . '/';
            $formatString = preg_replace($pattern, $this->phoneParts->shift(), $formatString, 1);
        });

        return $formatString;
    }

    public function getExtension(): ?string
    {
        return trim($this->extension);
    }
}

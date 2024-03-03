<?php

namespace App\Domain\Server\Enum;

enum HddTypeEnum implements OptionEnumInterface
{
    const SATA = 'SATA';
    const SATA2 = 'SATA2';
    const SAS = 'SAS';
    const SSD = 'SSD';

    public static function getList(): array
    {
        return [
            ['value' => self::SATA,'label' => self::SATA],
            ['value' => self::SAS,'label' => self::SAS],
            ['value' => self::SSD,'label' => self::SSD]
        ];
    }

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::SATA,
            self::SAS,
            self::SSD,
        ];
    }
}

<?php

namespace App\Modules\Server\Enum;

enum StorageEnum implements OptionEnumInterface
{
    const STORAGE_0 = '0';
    const STORAGE_2GB = '2GB';
    const STORAGE_4GB = '4GB';
    const STORAGE_8GB = '8GB';
    const STORAGE_2TB = '2TB';
    const STORAGE_3TB = '3TB';
    const STORAGE_4TB = '4TB';
    const STORAGE_8TB = '8TB';
    const STORAGE_12TB = '12TB';
    const STORAGE_24TB = '24TB';
    const STORAGE_48TB = '48TB';
    const STORAGE_72TB = '72TB';

    public static function getValueInGB(string $label): int
    {
        return match ($label) {
            self::STORAGE_0 => 0,
            self::STORAGE_2GB => 2,
            self::STORAGE_4GB => 4,
            self::STORAGE_8GB => 8,
            self::STORAGE_2TB => 2000,
            self::STORAGE_3TB => 3000,
            self::STORAGE_4TB => 4000,
            self::STORAGE_8TB => 8000,
            self::STORAGE_12TB => 12000,
            self::STORAGE_24TB => 24000,
            self::STORAGE_48TB => 48000,
            self::STORAGE_72TB => 72000,
        };
    }

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::STORAGE_0,
            self::STORAGE_2GB,
            self::STORAGE_4GB,
            self::STORAGE_8GB,
            self::STORAGE_2TB,
            self::STORAGE_3TB,
            self::STORAGE_4TB,
            self::STORAGE_8TB,
            self::STORAGE_12TB,
            self::STORAGE_24TB,
            self::STORAGE_48TB,
            self::STORAGE_72TB,
        ];
    }

    public static function getList(): array
    {
        return [
            ['value' => self::STORAGE_0,'label' => self::STORAGE_0],
            ['value' => self::STORAGE_2GB,'label' => self::STORAGE_2GB],
            ['value' => self::STORAGE_4GB,'label' => self::STORAGE_4GB],
            ['value' => self::STORAGE_8GB,'label' => self::STORAGE_8GB],
            ['value' => self::STORAGE_2TB,'label' => self::STORAGE_2TB],
            ['value' => self::STORAGE_3TB,'label' => self::STORAGE_3TB],
            ['value' => self::STORAGE_4TB,'label' => self::STORAGE_4TB],
            ['value' => self::STORAGE_8TB,'label' => self::STORAGE_8TB],
            ['value' => self::STORAGE_12TB,'label' => self::STORAGE_12TB],
            ['value' => self::STORAGE_24TB,'label' => self::STORAGE_24TB],
            ['value' => self::STORAGE_48TB,'label' => self::STORAGE_48TB],
            ['value' => self::STORAGE_72TB,'label' => self::STORAGE_72TB],
        ];
    }
}

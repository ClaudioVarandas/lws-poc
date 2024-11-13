<?php

namespace App\Modules\Server\Enum;

enum RamEnum implements OptionEnumInterface
{
    const RAM_2GB = '2GB';
    const RAM_4GB = '4GB';
    const RAM_8GB = '8GB';
    const RAM_12GB = '12GB';
    const RAM_16GB = '16GB';
    const RAM_24GB = '24GB';
    const RAM_32GB = '32GB';
    const RAM_48GB = '48GB';
    const RAM_64GB = '64GB';
    const RAM_96GB = '96GB';

    public static function getValueInGB(string $label): int
    {
        return match ($label) {
            self::RAM_2GB => 2,
            self::RAM_4GB => 4,
            self::RAM_8GB => 8,
            self::RAM_12GB => 12,
            self::RAM_16GB => 16,
            self::RAM_24GB => 24,
            self::RAM_32GB => 32,
            self::RAM_48GB => 48,
            self::RAM_64GB => 64,
            self::RAM_96GB => 96,
            default => false
        };
    }

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::RAM_2GB,
            self::RAM_4GB,
            self::RAM_8GB,
            self::RAM_12GB,
            self::RAM_16GB,
            self::RAM_24GB,
            self::RAM_32GB,
            self::RAM_48GB,
            self::RAM_64GB,
            self::RAM_96GB,
        ];
    }

    /**
     * @return array
     */
    public static function getList(): array
    {
        return [
            ['value' => self::RAM_2GB,'label' => self::RAM_2GB],
            ['value' => self::RAM_4GB,'label' => self::RAM_4GB],
            ['value' => self::RAM_8GB,'label' => self::RAM_8GB],
            ['value' => self::RAM_12GB,'label' => self::RAM_12GB],
            ['value' => self::RAM_16GB,'label' => self::RAM_16GB],
            ['value' => self::RAM_24GB,'label' => self::RAM_24GB],
            ['value' => self::RAM_32GB,'label' => self::RAM_32GB],
            ['value' => self::RAM_48GB,'label' => self::RAM_48GB],
            ['value' => self::RAM_64GB,'label' => self::RAM_64GB],
            ['value' => self::RAM_96GB,'label' => self::RAM_96GB],
        ];
    }
}

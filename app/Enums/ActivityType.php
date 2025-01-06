<?php

namespace App\Enums;

enum ActivityType: string
{
    case Individual = 'individual';
    case Group = 'group';

    /**
     * @return array
     */
    public static function casesForSelect() : array
    {
        $casesForSelect = [];
        foreach (self::cases() as $case) {
            $casesForSelect[] = ['value' => $case->value, 'label' => $case->name];
        }

        return $casesForSelect;
    }
}

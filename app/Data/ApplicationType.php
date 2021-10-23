<?php

namespace App\Data;

abstract class ApplicationType
{
    const WEB = 'WEB';
    const MOBILE = 'MOBILE';
    const DESKTOP = 'DESKTOP';

    public static function toList()
    {
        return [
            ApplicationType::WEB => ApplicationType::WEB,
            ApplicationType::MOBILE => ApplicationType::MOBILE,
            ApplicationType::DESKTOP => ApplicationType::DESKTOP,
        ];
    }
}

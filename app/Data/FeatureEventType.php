<?php

namespace App\Data;

interface FeatureEventType
{
    const CREATED = 'CREATED';
    const UPDATED = 'UPDATED';
    const TREATMENT_UPDATED = 'TREATMENT UPDATED';
    const TREATMENT_INFO_UPDATED = 'TREATMENT INFO UPDATED';
    const APPLICATION_ADDED = 'APPLICATION ADDED';
    const SCHEDULE = 'SCHEDULE';
    const ON_OFF = 'ON/OFF';
    const COMMENT = 'COMMENT';
    const OVERRIDE_ADDED = 'OVERRIDE ADDED';
    const OVERRIDE_DELETED = 'OVERRIDE DELETED';
    const ALLOCATION_UPDATED = 'ALLOCATION UPDATED';
    const PAUSE = 'PAUSE';
    const PLAY = 'PLAY';
    const OVERRIDE_TOGGLE = 'OVERRIDE TOGGLE';
    const SYSTEM = 'SYSTEM';
}

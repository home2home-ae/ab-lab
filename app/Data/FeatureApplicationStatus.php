<?php

namespace App\Data;

interface FeatureApplicationStatus
{
    // on mean feature is active
    const ON = 'ON';

    // off mean feature is turned off
    const OFF = 'OFF';

    // pause mean off but all setting will stay like this.. (maybe because of some error, we need to fix)
    const PAUSED = 'PAUSED';

    // launched mean C: 0
    const LAUNCHED = 'LAUNCHED';
}

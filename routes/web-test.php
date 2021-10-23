<?php

use Illuminate\Support\Facades\Route;


Route::get('/test', function () {

    /**
     * {
     * "feature": "AB_TEST_1_O9B_12000_6675",
     * "application": "SELLER",
     * "defaultTreatment": "SELLER",
     * "entityId": "0"
     * }
     */

    $url = 'http://ab-test.loc/api/treatment';

    $feature = 'AB_TEST_1_O9B_12000_6675';
    $applicaton = 'SELLER';
    $applicationStage = \ABTest\Accessor\Data\ApplicationStage::DEVELOPMENT;
    $defaultTreatment = \ABTest\Accessor\Data\FeatureTreatment::C;
    $entityId = '0';

    $helper = new \App\Helper\RedisFeatureHelper($feature, $applicaton, $applicationStage, $entityId, $defaultTreatment);

    $response = $helper->getTreatment();

    dd($response);

});

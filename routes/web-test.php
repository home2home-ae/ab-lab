<?php

use ABLab\Accessor\Data\ApplicationStage;
use ABLab\Accessor\Data\FeatureTreatment;
use ABLab\Accessor\Manager\RedisFeatureRetriever;
use ABLab\Accessor\Request\GetTreatmentRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;


Route::get('/test', function () {

    $feature = 'AB_TEST_1_BP0_12000_3543';
    $applicaton = 'H2H-SELLER';
    $applicationStage = ApplicationStage::PRODUCTION;
    $defaultTreatment = FeatureTreatment::C;
    $entityId = '555';

    $treatmentRequest = new GetTreatmentRequest($feature, $applicaton, $applicationStage, $entityId, $defaultTreatment);

    /** @var RedisFeatureRetriever $manager */
    $manager = app('ab-lab-accessor');

    $response = $manager->getTreatment($treatmentRequest);

    dd($response);

});

Route::get('/test-redis', function () {

    Redis::set('rummykhan', 'rummykhan');

    dd(Redis::get('rummykhan'));
});

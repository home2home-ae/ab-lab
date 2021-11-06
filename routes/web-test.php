<?php

use ABLab\Accessor\ABLabAccessor;
use ABLab\Accessor\Data\FeatureTreatment;
use ABLab\Accessor\Request\Builder\TreatmentRequestBuilder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;


Route::get('/test', function () {

    $feature = 'API_ENABLE_CODE_FOR_STORE_8XC_12004_4221';
    $entityId = '555';

    $treatmentRequest = TreatmentRequestBuilder::builder()
        ->setFeatureName($feature)
        ->setApplicationStage(\ABLab\Accessor\Data\ApplicationStage::PRODUCTION)
        ->build();

    /** @var ABLabAccessor $manager */
    $manager = app('ab-lab-accessor');

    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);
    $manager->getTreatment($treatmentRequest);

    dd($manager->dd());

});

Route::get('/test-redis', function () {

    Redis::set('rummykhan', 'rummykhan');

    dd(Redis::get('rummykhan'));
});

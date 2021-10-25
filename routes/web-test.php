<?php

use ABLab\Accessor\ABLabAccessor;
use ABLab\Accessor\Data\FeatureTreatment;
use ABLab\Accessor\Request\Builder\TreatmentRequestBuilder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;


Route::get('/test', function () {

    $feature = 'AB_TEST_1_BP0_12000_3543';
    $entityId = '555';

    $treatmentRequest = TreatmentRequestBuilder::builder()
        ->setFeatureName($feature)
        ->setEntityId($entityId)
        ->build();

    /** @var ABLabAccessor $manager */
    $manager = app('ab-lab-accessor');

    $treatment = $manager->getTreatment($treatmentRequest);

    // if true mean feature is not launched (C)
    echo FeatureTreatment::C == $treatment;

    // if true mean feature is launched (T1)
    echo FeatureTreatment::T1 == $treatment;

});

Route::get('/test-redis', function () {

    Redis::set('rummykhan', 'rummykhan');

    dd(Redis::get('rummykhan'));
});

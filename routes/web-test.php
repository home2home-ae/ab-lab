<?php

use ABLab\Accessor\ABLabAccessor;
use ABLab\Accessor\Data\FeatureTreatment;
use ABLab\Accessor\Manager\RedisFeatureRetriever;
use ABLab\Accessor\Request\Builder\TreatmentRequestBuilder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;


Route::get('/test', function () {

    $feature = 'REDUCE_ADDON_PRICE_TO_ZERO_A1S_12003_4870';
    $entityId = '42';

    $treatmentRequest = TreatmentRequestBuilder::builder()
        ->setFeatureName($feature)
        ->setApplicationStage(\ABLab\Accessor\Data\ApplicationStage::PRODUCTION)
        ->setApplication('H2H-API')
        ->setEntityId($entityId)
        ->setDefaultTreatment('C')
        ->build();

    /** @var RedisFeatureRetriever $manager */
    $manager = app('ab-lab-accessor')->withImplementation('redis');

    $response = $manager->getTreatment($treatmentRequest);

    dd($manager, $treatmentRequest, $response);

});

Route::get('/test-redis', function () {

    Redis::set('rummykhan', 'rummykhan');

    dd(Redis::get('rummykhan'));
});

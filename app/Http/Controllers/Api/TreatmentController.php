<?php

namespace App\Http\Controllers\Api;

use ABLab\Accessor\Manager\RedisFeatureRetriever;
use ABLab\Accessor\Request\Builder\TreatmentRequestBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function getTreatment(Request $request)
    {
        $builder = TreatmentRequestBuilder::builder()
            ->setFeatureName($request->get('featureName'))
            ->setApplication($request->get('application'))
            ->setApplicationStage($request->get('applicationStage'))
            ->setDefaultTreatment($request->get('defaultTreatment'));

        if ($request->has('entityId') && !empty($request->get('entityId'))) {
            $builder->setEntityId($request->get('entityId'));
        }

        $treatmentRequest = $builder->build();

        /** @var RedisFeatureRetriever $manager */
        $manager = app('ab-lab-accessor')->withImplementation('redis');
        $response = $manager->getTreatment($treatmentRequest);

        return response()->json([
            'treatment' => $response->getTreatment(),
            'request' => $treatmentRequest->toArray(),
            'response' => $response->toArray(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Helper\RedisFeatureHelper;
use App\Http\Controllers\Controller;
use App\Response\TreatmentResponse;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function getTreatment(Request $request)
    {
        $feature = $request->get('feature');
        $application = $request->get('application');
        $defaultTreatment = $request->get('defaultTreatment');
        $entityId = $request->get('entityId');

        $helper = new RedisFeatureHelper($feature, $application, $defaultTreatment, $entityId);


        return response()->json([
            'data' => $helper->getTreatmentResponse()
        ]);
    }
}

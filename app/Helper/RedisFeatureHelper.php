<?php

namespace App\Helper;

use ABTest\Accessor\Data\ApplicationStage;
use ABTest\Accessor\Data\FeatureTreatment;
use App\Response\TreatmentResponse;
use Exception;
use Illuminate\Support\Facades\Redis;

class RedisFeatureHelper
{
    const CONNECTION_NAME = 'default';

    private string $featureName;
    private string $applicationStage;
    private string $application;
    private string $entityId;
    private string $defaultTreatment;

    public function __construct(string $featureName, string $application, string $applicationStage, string $entityId, string $defaultTreatment = null)
    {
        $this->featureName = $featureName;
        $this->application = $application;
        $this->applicationStage = $applicationStage;
        $this->entityId = $entityId;
        $this->defaultTreatment = $defaultTreatment;

        $this->validateInputs();
    }

    protected function validateInputs()
    {
        if (!in_array($this->applicationStage, array_keys(ApplicationStage::toList()))) {
            throw new Exception("{$this->applicationStage} is not a supported stage.");
        }

        if (!in_array($this->defaultTreatment, array_keys(FeatureTreatment::toList()))) {
            throw new Exception("{$this->defaultTreatment} is not a supported treatment.");
        }
    }

    public function getTreatment(): TreatmentResponse
    {
        $response = Redis::connection(RedisFeatureHelper::CONNECTION_NAME)
            ->get($this->featureName);

        if ($response === null) {
            return new TreatmentResponse($response, [], $this->defaultTreatment);
        }

        $response = json_decode($response, true);

        dd($response);


        return new TreatmentResponse();
    }
}

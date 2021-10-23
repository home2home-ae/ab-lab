<?php

namespace App\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class TreatmentResponse implements Arrayable, Jsonable
{
    protected string|null $rawResponse;
    protected array $arrayConvertedResponse;
    protected string $treatmentAvailable;

    public function __construct(string|null $rawResponse, array $arrayConvertedResponse, string $treatmentAvailable)
    {
        $this->rawResponse = $rawResponse;
        $this->arrayConvertedResponse = $arrayConvertedResponse;
        $this->treatmentAvailable = $treatmentAvailable;
    }

    public function toArray()
    {
        return [
            'raw' => $this->rawResponse,
            'response' => $this->arrayConvertedResponse,
            'treatment' => $this->treatmentAvailable
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}

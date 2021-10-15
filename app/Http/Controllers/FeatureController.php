<?php

namespace App\Http\Controllers;

use App\Data\ApplicationStage;
use App\Data\FeatureApplicationStatus;
use App\Data\FeatureTreatment;
use App\Data\FeatureType;
use App\Models\Application;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FeatureController extends Controller
{
    public function index()
    {
        return view('features.index');
    }

    public function create()
    {
        return view('features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => [
                'required',
                Rule::in([FeatureType::EXPERIMENT, FeatureType::LAUNCH])
            ],
            'prefix' => [
                'required',
                'regex:/^[A-Z0-9_]+$/'
            ],
            'title' => [
                'required',
                'max: 128'
            ],
            'description' => [
                'required',
                'max:1024'
            ]
        ]);

        $stringRandomSuffix = strtoupper(Str::random(3));
        $countSuffix = 12000 + Feature::count();
        $randomSuffix = rand(1000, 10000);

        $featureName = $request->get('prefix') . '_' . $stringRandomSuffix . '_' . $countSuffix . '_' . $randomSuffix;

        $validator = Validator::make([
            'featureName' => $featureName
        ], [
            'featureName' => [
                'required',
                Rule::unique('features', 'name')
            ]
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please choose a different feature prefix');
        }

        $model = new Feature();
        $model->name = $featureName;
        $model->type = $request->get('type');
        $model->title = $request->get('title');
        $model->description = $request->get('description');
        $model->user_id = Auth::id();
        $model->save();

        return redirect()->route('feature-detail', ['id' => $model->id])
            ->with('success', 'Feature created successfully!');
    }

    public function show($name)
    {
        $model = Feature::where('name', $name)->firstOrFail();

        return view('features.show', compact('model'));
    }

    public function showTreatments($name)
    {
        $model = Feature::where('name', $name)->firstOrFail();

        return view('features.show-treatments', compact('model'));
    }

    public function featureActivation($name)
    {
        /** @var Feature $model */
        $model = Feature::where('name', $name)->firstOrFail();

        $addedApplicationIds = $model->applications()->pluck('application_id')->toArray();

        $applications = Application::query()->whereNotIn('id', $addedApplicationIds)->get();

        $applicationList = $applications->pluck('name', 'id')->toArray();

        return view('features.activation', compact('model', 'applications', 'applicationList'));
    }

    public function activateApplication($name, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::where('name', $name)->firstOrFail();

        $request->validate([
            'application' => [
                'required',
                Rule::exists('applications', 'id'),
                Rule::notIn($model->applications()->pluck('application_id')->toArray())
            ]
        ]);

        $applicationModel = $model->applications()->where('application_id', $request->get('application'))->first();
        if ($applicationModel) {
            return back()->with('error', 'application model already present');
        }

        DB::beginTransaction();

        try {

            $app = new Feature\FeatureApplication();
            $app->application_id = $request->get('application');
            $app->feature_id = $model->id;
            $app->status = FeatureApplicationStatus::OFF;
            $app->save();

            $devoApp = new Feature\FeatureApplicationDevo();
            $devoApp->application_id = $request->get('application');
            $devoApp->feature_id = $model->id;
            $devoApp->status = FeatureApplicationStatus::OFF;
            $devoApp->save();


            $app->addTreatments($model);
            $devoApp->addTreatments($model);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();

            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', 'application activated successfully!');
    }

    public function addTreatment($name)
    {
        /** @var Feature $model */
        $model = Feature::where('name', $name)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($model->treatments()->count() >= 4) {
            return back()->with('error', 'FeatureTreatment already added.');
        }

        $treatments = [
            FeatureTreatment::C,
            FeatureTreatment::T1,
            FeatureTreatment::T2,
            FeatureTreatment::T3,
        ];

        foreach ($treatments as $treatment) {

            if ($model->treatments()->where('name', $treatment)->first()) {
                continue;
            }

            $treatmentModel = new Feature\FeatureTreatment();
            $treatmentModel->name = $treatment;
            $treatmentModel->description = '';
            $treatmentModel->feature_id = $model->id;
            $treatmentModel->save();

            $treatmentModel->updateProdApplication($model);
            $treatmentModel->updateDevoApplication($model);

            return back()->with('success', 'FeatureTreatment added');
        }

        return back()->with('info', 'Treatments already added');
    }

    public function updateTreatment($name, $treatment, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::where('name', $name)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        /** @var Feature\FeatureTreatment $treatmentModel */
        $treatmentModel = $model->treatments()->where('id', $treatment)->firstOrFail();

        $request->validate([
            'description' => [
                'required'
            ]
        ]);

        $treatmentModel->description = $request->get('description');
        $treatmentModel->save();

        return back()->with('info', 'Treatments description updated');
    }

    public function modifyAllocation($name, $stage, $application)
    {
        /** @var Feature $model */
        $model = Feature::where('name', $name)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($stage === ApplicationStage::DEVELOPMENT) {
            $application = $model->devoApplications()->where('id', $application)->first();
        } else if ($stage === ApplicationStage::PRODUCTION) {
            $application = $model->applications()->where('id', $application)->first();
        } else {
            throw new \Exception("Stage: {$stage} is not supported..");
        }


        return view('features.activation.modify-allocations', compact('model', 'application', 'stage'));
    }

    public function updateAllocations($name, $stage, $application, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::where('name', $name)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        /** @var Feature\FeatureApplicationDevo|Feature\FeatureApplication $featureApplication */
        if ($stage === ApplicationStage::DEVELOPMENT) {
            $featureApplication = $model->devoApplications()->where('id', $application)->first();
        } else if ($stage === ApplicationStage::PRODUCTION) {
            $featureApplication = $model->applications()->where('id', $application)->first();
        } else {
            throw new \Exception("Stage: {$stage} is not supported..");
        }

        $sum = 0;
        foreach ($request->get('allocations') as $treatmentId => $allocation) {

            // verify treatment belongs to application
            $featureApplication->treatments()->where('feature_treatments.id', $treatmentId)->firstOrFail();

            $sum += intval($allocation);
        }

        if ($sum > 100) {
            return back()->with('error', 'Allocation percentage for all the treatments cannot exceed 100% and is currently being set at ' . $sum . '%');
        }

        foreach ($request->get('allocations') as $treatmentId => $allocation) {
            // get feature treatment
            $featureTreatment = $featureApplication->treatments()->where('feature_treatments.id', $treatmentId)->firstOrFail();

            $featureTreatment->pivot->allocation = intval($allocation);
            $featureTreatment->pivot->save();
        }


        return back()->with('success', 'Feature treatment allocations updated.');
    }
}

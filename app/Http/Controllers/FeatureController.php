<?php

namespace App\Http\Controllers;

use ABLab\Accessor\Data\FeatureTreatment;
use ABLab\Accessor\Data\ApplicationStage;
use App\Data\FeatureApplicationStatus;
use App\Data\FeatureEventType;
use App\Data\FeatureOverride;
use ABLab\Accessor\Data\FeatureType;
use App\Events\FeatureUpdate;
use App\Models\Application;
use App\Models\Feature;
use Faker\Provider\en_UG\PhoneNumber;
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
        $builder = Feature::query();


        $results = $builder->paginate();

        return view('features.index', compact('results'));
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

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::CREATED, []);

        return redirect()->route('feature-detail', ['name' => $model->name])
            ->with('success', 'Feature created successfully!');
    }

    public function update($name, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        $request->validate([
            'type' => [
                'required',
                Rule::in([FeatureType::EXPERIMENT, FeatureType::LAUNCH])
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

        $model->update($request->all());

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::UPDATED, [
            'title' => $model->title,
            'type' => $model->type,
            'description' => $model->description
        ]);

        return back()->with('success', 'Feature updated successfully!');
    }

    public function show($name)
    {
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        return view('features.show', compact('model'));
    }

    public function showTreatments($name)
    {
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        return view('features.show-treatments', compact('model'));
    }

    public function featureActivation($name)
    {
        /** @var Feature $model */
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        $addedApplicationIds = $model->applications()->pluck('application_id')->toArray();

        $applications = Application::query()->whereNotIn('id', $addedApplicationIds)->get();

        $applicationList = $applications->pluck('name', 'id')->toArray();

        return view('features.activation', compact('model', 'applications', 'applicationList'));
    }

    public function featureOverrides($name)
    {
        /** @var Feature $model */
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        $treatmentList = $model->treatments()->pluck('name', 'id')->toArray();

        return view('features.overrides', compact('model', 'treatmentList'));
    }

    public function addFeatureOverride($name, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        if ($model->overrides()->count() >= FeatureOverride::THRESHOLD) {
            return back()->with('error', 'Overrides already reached ' . FeatureOverride::THRESHOLD . ', You should launch this feature to 100% now!!');
        }


        $request->validate([
            'treatment' => [
                'required',
                Rule::exists('feature_treatments', 'id')->where('feature_id', $model->id)
            ],
            'value' => [
                'required',
                Rule::unique('feature_overrides', 'value')->where('feature_treatment_id', $request->get('treatment'))
            ]
        ]);

        if (Feature\FeatureOverride::query()
            ->where('value', $request->get('value'))
            ->where('feature_id', $model->id)
            ->first()) {
            return back()->with('error', 'This entity id is already over ridden, please remove the existing override first.');
        }

        $featureOverride = new Feature\FeatureOverride();
        $featureOverride->value = $request->get('value');
        $featureOverride->feature_treatment_id = $request->get('treatment');
        $featureOverride->feature_id = $model->id;
        $featureOverride->save();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::OVERRIDE_ADDED, [
            'entity_id' => $featureOverride->value,
            'treatment' => $featureOverride->treatment->name
        ]);

        return back()->with('success', 'Feature override added successfully!');
    }

    public function deleteFeatureOverride($name, $value, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

        /** @var Feature\FeatureOverride $override */
        $override = $model->overrides()->where('value', $value)->firstOrFail();

        $entity_id = $override->value;
        $treatment = $override->treatment->name;

        $override->delete();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::OVERRIDE_DELETED, [
            'entity_id' => $entity_id,
            'treatment' => $treatment
        ]);

        return back()->with('success', 'Feature override removed successfully!');
    }

    public function activateApplication($name, Request $request)
    {
        /** @var Feature $model */
        $model = Feature::query()->where('user_id', Auth::id())
            ->where('name', $name)->firstOrFail();

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

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::APPLICATION_ADDED, [
            'application' => $app->application->name,
        ]);

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

        $oldTreatments = $model->treatments()->pluck('name')->toArray();

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

        $newTreatments = $model->treatments()->pluck('name')->toArray();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::TREATMENT_UPDATED, [
            'old' => $oldTreatments,
            'new' => $newTreatments,
        ]);

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

        $oldDescription = $treatmentModel->description;

        $treatmentModel->description = $request->get('description');
        $treatmentModel->save();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::TREATMENT_INFO_UPDATED, [
            'treatment' => $treatmentModel->name,
            'old' => $oldDescription,
            'new' => $treatmentModel->description
        ]);

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

            /** @var Feature\FeatureTreatment $featureTreatment */
            $featureTreatment = $featureApplication->treatments()->where('feature_treatments.id', $treatmentId)->firstOrFail();

            $featureTreatment->pivot->allocation = intval($allocation);
            $featureTreatment->pivot->save();

            // paused, if C=100
            if ($featureTreatment->name === FeatureTreatment::C && intval($allocation) === 100) {
                $featureApplication->status = FeatureApplicationStatus::ON;
                $featureApplication->save();

                // launched, if C=0
            } else if ($featureTreatment->name === FeatureTreatment::C && intval($allocation) === 0) {
                $featureApplication->status = FeatureApplicationStatus::LAUNCHED;
                $featureApplication->save();

                // On, if any other than C > 0,
            } else if ($featureTreatment->name !== FeatureTreatment::C && intval($allocation) > 0) {
                $featureApplication->status = FeatureApplicationStatus::ON;
                $featureApplication->save();
            }

            FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::ALLOCATION_UPDATED, [
                'treatment' => $featureTreatment->name,
                'allocation' => $allocation
            ]);
        }


        return back()->with('success', 'Feature treatment allocations updated.');
    }

    public function toggleOverrides($name, $stage, $application, Request $request)
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


        $featureApplication->are_overrides_active = !$featureApplication->are_overrides_active;
        $featureApplication->save();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::OVERRIDE_TOGGLE, [
            'feature' => $model->name,
            'application' => $featureApplication->application->name,
            'applicationId' => $featureApplication->id,
            'stage' => $stage,
            'state' => $featureApplication->are_overrides_active ? 'Turn ON' : 'Turn Off'
        ]);

        return back()->with('success', 'Overriedes are toggled.');
    }

    public function pauseFeature($name, $stage, $application, Request $request)
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

        $featureApplication->status = FeatureApplicationStatus::PAUSED;
        $featureApplication->save();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::PAUSE, [
            'feature' => $model->name,
            'application' => $featureApplication->application->name,
            'applicationId' => $featureApplication->id,
            'stage' => $stage,
        ]);

        return back()->with('success', 'Application status changed to paused.');
    }

    public function playFeature($name, $stage, $application, Request $request)
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

        $featureApplication->status = FeatureApplicationStatus::ON;
        $featureApplication->save();

        FeatureUpdate::dispatch(Auth::user(), $model, FeatureEventType::PLAY, [
            'feature' => $model->name,
            'application' => $featureApplication->application->name,
            'applicationId' => $featureApplication->id,
            'stage' => $stage,
        ]);

        return back()->with('success', 'Application status changed to on.');
    }
}

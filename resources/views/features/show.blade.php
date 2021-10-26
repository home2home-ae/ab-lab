<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Basic Info'],
    ]"></x-page-header>

    @section('title', 'Create feature')

    <x-card>

        <div class="d-block mb-8">
            @include('features.show.links')
        </div>

        <x-form action="{{ route('update-feature', ['name' => $model->name]) }}" method="PUT"
                id="update-form">

            <x-flash class="my-2" />

            <div class="row mt-5">

                <div class="col-md-6 col-sm-12">
                    <x-label>Type</x-label>
                    <div class="mt-3">

                        <div class="d-inline-block">
                            <x-radio id="launch" required name="type"
                                     value="{{ \ABLab\Accessor\Data\FeatureType::LAUNCH }}"
                                     :checked="$model->type === \ABLab\Accessor\Data\FeatureType::LAUNCH"
                                     label="Launch"></x-radio>
                        </div>

                        <div class="d-inline-block mx-3">
                            <x-radio id="experiment" required name="type"
                                     value="{{ \ABLab\Accessor\Data\FeatureType::EXPERIMENT }}"
                                     :checked="$model->type === \ABLab\Accessor\Data\FeatureType::EXPERIMENT"
                                     label="Experiment"></x-radio>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <x-form-group disabled label="Prefix" name="prefix"
                                  value="{{ $model->name }}"></x-form-group>
                </div>
            </div>

            <div class="mt-3">
                <x-form-group required="required" label="Title" name="title"
                              value="{{ old('title') ?? $model->title }}"></x-form-group>
            </div>

            <div class="mt-3">
                <x-form-group required="required" type="textarea" label="Description"
                              value="{{ old('description') ?? $model->description }}"
                              name="description"></x-form-group>
            </div>

            <div class="grid grid-cols-1 mt-2">
                <div class="w-1/4">
                    <x-button>
                        <i class="tio-update"></i> Update basic info
                    </x-button>
                </div>

            </div>

        </x-form>

    </x-card>
</x-app-layout>

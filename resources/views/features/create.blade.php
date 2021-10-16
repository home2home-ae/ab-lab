<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => 'Create feature'],
    ]"></x-page-header>

    @section('title', 'Create feature')

    <x-card>

        <x-form action="{{ route('store-feature') }}" method="POST">

            <x-flash class="my-2" />

            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <x-label>Type</x-label>
                    <div class="d-block mt-3">
                        <x-radio id="launch" required name="type" value="{{ \App\Data\FeatureType::LAUNCH }}"
                                 label="Launch"></x-radio>
                        <x-radio id="experiment" required name="type" value="{{ \App\Data\FeatureType::EXPERIMENT }}"
                                 label="Experiment"></x-radio>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <x-form-group required="required" label="Prefix" name="prefix"></x-form-group>
                </div>

            </div>

            <div class="grid grid-cols-1 mt-3">
                <x-form-group required="required" label="Title" name="title"></x-form-group>
            </div>

            <div class="grid grid-cols-1 mt-3">
                <x-form-group required="required" type="textarea" label="Description" name="description"></x-form-group>
            </div>

            <div class="grid grid-cols-1 mt-2">
                <div class="w-1/4">
                    <x-button>Create Feature</x-button>
                </div>

            </div>

        </x-form>

    </x-card>
</x-app-layout>

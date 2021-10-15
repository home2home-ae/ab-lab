<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Basic Info'],
    ]"></x-page-header>

    @section('title', 'Create feature')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="d-block mb-8">
                        @include('features.show.links')
                    </div>

                    <x-form action="{{ route('update-feature', ['name' => $model->name]) }}" method="POST"
                            id="update-form">

                        <x-flash class="my-5"></x-flash>

                        <div class="grid md:grid-cols-2 md:gap-4 sm:grid-cols-1">

                            <div class="d-block">
                                <x-label>Type</x-label>
                                <div class="d-block mt-3">
                                    <x-radio id="launch" required name="type"
                                             value="{{ \App\Data\FeatureType::LAUNCH }}"
                                             :checked="$model->type === \App\Data\FeatureType::LAUNCH"
                                             label="Launch"></x-radio>
                                    <x-radio id="experiment" required name="type"
                                             value="{{ \App\Data\FeatureType::EXPERIMENT }}"
                                             :checked="$model->type === \App\Data\FeatureType::EXPERIMENT"
                                             label="Experiment"></x-radio>
                                </div>
                            </div>

                            <x-form-group disabled label="Prefix" name="prefix"
                                          value="{{ $model->name }}"></x-form-group>
                        </div>

                        <div class="grid grid-cols-1 mt-3">
                            <x-form-group required="required" label="Title" name="title"
                                          value="{{ old('title') ?? $model->title }}"></x-form-group>
                        </div>

                        <div class="grid grid-cols-1 mt-3">
                            <x-form-group required="required" type="textarea" label="Description"
                                          value="{{ old('description') ?? $model->description }}"
                                          name="description"></x-form-group>
                        </div>

                        <div class="grid grid-cols-1 mt-2">
                            <div class="w-1/4">
                                <x-button>Update Feature</x-button>
                            </div>

                        </div>

                    </x-form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

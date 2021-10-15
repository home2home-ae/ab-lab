<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['url' => route('feature-activation', ['name' => $model->name]), 'label' => 'Activation'],
        ['label' => $stage .' allocations'],
    ]"></x-page-header>

    @section('title', 'Activation')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="d-block mb-8">
                        @include('features.show.links')
                    </div>

                    <x-flash class="my-5"/>

                    @if($stage === \App\Data\ApplicationStage::PRODUCTION)
                        @include('features.activation.table', [
                                            'applications' => $model->applications,
                                            'name' => $model->name,
                                            'stage' => \App\Data\ApplicationStage::PRODUCTION
                                            ])
                    @endif

                    @if($stage === \App\Data\ApplicationStage::DEVELOPMENT)
                        @include('features.activation.table', [
                                            'applications' => $model->devoApplications,
                                            'name' => $model->name,
                                            'stage' => \App\Data\ApplicationStage::DEVELOPMENT
                                            ])
                    @endif

                    <div class="d-block mt-5">
                        <x-form
                            action="{{ route('modify-allocations', ['name' => $model->name, 'stage' => $stage, 'application' => $application->id]) }}"
                            method="PUT">
                            @foreach($application->treatments as $treatment)
                                <div class="d-block mt-5 mb-3">
                                    <x-form-group type="number" step="1" min="0" max="100"
                                                  label="Treatment {{ $treatment->name }} allocations"
                                                  name="allocations[{{$treatment->id}}]"
                                                  value="{{ $treatment->pivot->allocation }}"></x-form-group>
                                </div>
                            @endforeach

                            <div class="d-block mt-5">
                                <x-button>Update allocations</x-button>
                            </div>
                        </x-form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

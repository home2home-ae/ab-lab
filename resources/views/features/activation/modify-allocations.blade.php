<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['url' => route('feature-activation', ['name' => $model->name]), 'label' => 'Activation'],
        ['label' => $stage .' allocations'],
    ]"></x-page-header>

    @section('title', 'Activation')

    <x-card>

        <div class="d-block mb-8">
            @include('features.show.links')
        </div>

        <x-flash class="my-2"/>

        <div class="mt-3">
            <x-link
                href="{{ route('feature-activation', ['name' => $model->name]) }}"
                class="btn btn-soft-primary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to activation
            </x-link>
        </div>

        <div class="mt-3">
            @if($stage === \ABLab\Accessor\Data\ApplicationStage::PRODUCTION)
                @include('features.activation.table', [
                                    'applications' => $model->applications,
                                    'name' => $model->name,
                                    'stage' => \ABLab\Accessor\Data\ApplicationStage::PRODUCTION
                                    ])
            @endif

            @if($stage === \ABLab\Accessor\Data\ApplicationStage::DEVELOPMENT)
                @include('features.activation.table', [
                                    'applications' => $model->devoApplications,
                                    'name' => $model->name,
                                    'stage' => \ABLab\Accessor\Data\ApplicationStage::DEVELOPMENT
                                    ])
            @endif
        </div>

        <div class="d-block mt-5">
            <x-form
                action="{{ route('modify-allocations', ['name' => $model->name, 'stage' => $stage, 'application' => $application->id]) }}"
                method="PUT">

                <div class="row">
                    <div class="col-md-5 col-sm-12">

                        <div>

                        </div>

                        @foreach($application->treatments as $treatment)
                            <div class="d-block mt-2 mb-3">
                                <x-form-group type="number" step="1" min="0" max="100"
                                              label="Treatment {{ $treatment->name }} allocations"
                                              name="allocations[{{$treatment->id}}]"
                                              value="{{ $treatment->pivot->allocation }}"></x-form-group>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-block mt-2">
                    <x-button>Update allocations</x-button>
                </div>
            </x-form>
        </div>


    </x-card>
</x-app-layout>

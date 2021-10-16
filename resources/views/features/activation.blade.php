<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Activation'],
    ]"></x-page-header>

    @section('title', 'Activation')

    <x-card>

        <div class="d-block mb-8">
            @include('features.show.links')
        </div>

        <x-flash class="my-2"/>

        <div class="row mt-3">
            <div class="col-12">


                <x-form action="{{ route('activate-application', ['name' => $model->name]) }}" method="POST">


                    <x-select-group label="Activate application" name="application" placeholder="Select application"
                                    :list="$applicationList"/>


                    <div class="form-group mt-3">
                        <x-button class="">Activate application</x-button>
                    </div>

                </x-form>
            </div>
        </div>

        @include('features.activation.table', [
                            'applications' => $model->applications,
                            'name' => $model->name,
                            'stage' => \App\Data\ApplicationStage::PRODUCTION
                            ])

        @include('features.activation.table', [
                            'applications' => $model->devoApplications,
                            'name' => $model->name,
                            'stage' => \App\Data\ApplicationStage::DEVELOPMENT
                            ])


    </x-card>
</x-app-layout>

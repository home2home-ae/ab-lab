<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Activation'],
    ]"></x-page-header>

    @section('title', 'Activation')

    <x-card>

        @include('features.show.links')

        <x-flash class="my-2"/>

        <div class="row mt-3">
            <div class="col-md-4 col-sm-12">


                <x-form action="{{ route('activate-application', ['name' => $model->name]) }}" method="POST">


                    <x-select-group label="Activate application" name="application" placeholder="Select application"
                                    :list="$applicationList"/>


                    <div class="form-group mt-3">
                        <x-button class="">
                            <i class="tio-checkmark-circle"></i> Activate application
                        </x-button>
                    </div>

                </x-form>
            </div>
        </div>

        @if($model->applications->count() > 0)
            @include('features.activation.table', [
                                'applications' => $model->applications,
                                'name' => $model->name,
                                'stage' => \ABLab\Accessor\Data\ApplicationStage::PRODUCTION
                                ])
        @endif

        @if($model->devoApplications->count() > 0)
            @include('features.activation.table', [
                                'applications' => $model->devoApplications,
                                'name' => $model->name,
                                'stage' => \ABLab\Accessor\Data\ApplicationStage::DEVELOPMENT
                                ])
        @endif


    </x-card>
</x-app-layout>

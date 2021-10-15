<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Activation'],
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

                    <x-form action="{{ route('activate-application', ['name' => $model->name]) }}" method="POST">


                        <x-select-group label="Activate application" name="application" placeholder="Select application"
                                        :list="$applicationList"/>


                        <x-button class="mt-5 mb-3">Add treatment</x-button>

                    </x-form>

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


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

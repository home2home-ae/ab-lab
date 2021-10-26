<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Treatments'],
    ]"></x-page-header>

    @section('title', 'Create feature')

    <x-card>

        @include('features.show.links')

        <x-flash class="my-2"/>

        @if($model->treatments->count() < 4)

            <x-form action="{{ route('add-treatment', ['name' => $model->name]) }}" method="POST"
                    id="treatment-form">

                @if($model->treatments->count() > 0)
                    <x-button>
                        <i class="tio-add"></i> Add another treatment
                    </x-button>
                @else
                    <x-button>
                        <i class="tio-add"></i> Add treatment
                    </x-button>
                @endif
            </x-form>
        @endif

        @if($model->treatments()->count() > 0)

            <div class="row my-3">

                @foreach($model->treatments as $treatment)
                    @include('features.treatments.treatment', ['treatment' => $treatment])
                @endforeach
            </div>
        @endif

    </x-card>
</x-app-layout>

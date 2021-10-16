<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Treatments'],
    ]"></x-page-header>

    @section('title', 'Create feature')

    <x-card>

        <div class="d-block mb-8">
            @include('features.show.links')
        </div>

        <x-flash class="my-2" />

        @if($model->treatments()->count() > 0)
            <div class="row my-3">
                @foreach($model->treatments as $treatment)
                    <div class="col-md-3 col-sm-6">
                        <x-form
                            action="{{ route('update-treatment', ['name' => $model->name, 'treatment' => $treatment->id]) }}"
                            method="PUT"
                            id="treatment-form-{{$treatment->id}}">

                            <div class="card">

                                <div
                                    class="bg-gradient-to-r from-{{ $loop->iteration == 1 ? 'yellow' :  ( $loop->iteration == 2 ? 'green' : 'blue') }}-400 via-red-500 to-pink-500 h-2"></div>
                                <div class="card-body">

                                    <div class="card-title">
                                        <h5 class="">{{ $treatment->name }}</h5>
                                    </div>

                                    <x-form-group required="required" type="textarea"
                                                  placeholder="Add description for {{$treatment->name}} treatment"
                                                  value="{{ $treatment->description }}"
                                                  name="description"></x-form-group>

                                    <div class="form-group mt-3">
                                        <x-button color="primary">Update</x-button>
                                    </div>

                                </div>
                            </div>
                        </x-form>
                    </div>
                @endforeach
            </div>
        @endif

        @if($model->treatments->count() < 4)
            <x-form action="{{ route('add-treatment', ['name' => $model->name]) }}" method="POST"
                    id="treatment-form">
                <x-button>Add treatment</x-button>
            </x-form>
        @endif

    </x-card>
</x-app-layout>

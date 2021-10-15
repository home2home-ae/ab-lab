<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Treatments'],
    ]"></x-page-header>

    @section('title', 'Create feature')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="d-block mb-8">
                        @include('features.show.links')
                    </div>

                    <x-flash class="my-5"></x-flash>

                    @if($model->treatments()->count() > 0)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($model->treatments as $treatment)
                                <x-form
                                    action="{{ route('update-treatment', ['name' => $model->name, 'treatment' => $treatment->id]) }}"
                                    method="PUT"
                                    id="treatment-form-{{$treatment->id}}">
                                    <!-- This is an example component -->
                                    <div class="max-w-lg mx-auto">
                                        <div class="bg-white shadow-md border border-gray-200 rounded-lg max-w-sm mb-5">
                                            <div
                                                class="bg-gradient-to-r from-{{ $loop->iteration == 1 ? 'yellow' :  ( $loop->iteration == 2 ? 'green' : 'blue') }}-400 via-red-500 to-pink-500 h-2"></div>
                                            <div class="p-5">
                                                <a href="#">
                                                    <h5 class="text-gray-900 font-bold text-2xl tracking-tight mb-2">{{ $treatment->name }}</h5>
                                                </a>
                                                <x-form-group required="required" type="textarea"
                                                              placeholder="Add description for {{$treatment->name}} treatment"
                                                              value="{{ $treatment->description }}"
                                                              name="description"></x-form-group>
                                                <x-button color="primary">Update</x-button>
                                            </div>
                                        </div>
                                    </div>
                                </x-form>
                            @endforeach
                        </div>
                    @endif

                    @if($model->treatments->count() < 4)
                        <x-form action="{{ route('add-treatment', ['name' => $model->name]) }}" method="POST"
                                id="treatment-form">
                            <x-button>Add treatment</x-button>
                        </x-form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

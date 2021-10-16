<x-app-layout>

    <x-page-header :links="[
        ['url' => route('dashboard'),'label' => 'Dashboard'],
        ['url' => route('features'),'label' => 'Features'],
        ['label' => $model->name ],
        ['label' => 'Overrides'],
    ]"></x-page-header>

    @section('title', 'Overrides')

    <x-card>

        <div class="d-block mb-8">
            @include('features.show.links')
        </div>

        <x-flash class="my-2"/>




        <table class="table mt-5">
            <thead>
            <tr class="">
                <th class="">#</th>
                <th class="">Entity Id</th>
                <th class="">Treatment</th>
                <th class=""></th>
                <th class=""></th>
            </tr>
            </thead>
            <tbody class="">
            @foreach($model->overrides as $override)
                <tr class="">
                    <td class="">{{ $loop->iteration }}</td>
                    <td class="">{{ $override->value }}</td>
                    <td class="">{{ $override->treatment->name }}</td>

                    <td class="">
                        {{ $override->created_at }}
                    </td>

                    <td class="">
                        <x-form
                            action="{{ route('delete-override', ['name' => $model->name, 'value' => $override->value]) }}"
                            id="delete-override-{{$override->value}}"
                            method="DELETE"
                        ></x-form>

                        <x-button
                            data-target="#delete-override-{{$override->value}}"
                            onclick="if(confirm('Are you sure?')){$($(this).attr('data-target')).submit();}"
                            class="">
                            Delete
                        </x-button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        @if($model->overrides->count() < 21)
            <x-form action="{{ route('add-override', ['name' => $model->name]) }}" method="POST">
                <div class="row">


                    <div class="col-md-3 col-sm-6">
                        <x-form-group label="EntityId" name="value">
                        </x-form-group>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <x-select-group type="select" label="Select treatment" name="treatment"
                                        placeholder="Select treatment"
                                        :list="$treatmentList">
                        </x-select-group>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <x-button
                            class="mt-4 mb-3">
                            Add Override
                        </x-button>
                    </div>

                </div>

            </x-form>
        @endif

    </x-card>
</x-app-layout>
